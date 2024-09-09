<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
     public function handleForm(Request $request)
    {
        $action = $request->input('action');

        // Validate input
        $validatedData = $request->validate([
            'emp_fullname' => 'required|string|max:255',
            'email_company' => 'required|email|max:255',
            'email_personal' => 'required|email|max:255',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'defaultPassword' => 'required|string|min:6',
        ]);

        // Check if hod_id is available in the session
        $validatedData['hod_id'] = session('hod_id');

        if ($action === 'invite') {
            // Generate token and store in the invitation table
            $token = Str::random(60);
            Invitation::create([
                'email_personal' => $validatedData['email_personal'],
                'token' => $token,
            ]);

            // Send an invitation email
            $this->sendInvitation($validatedData, $token);
            return response()->json(['message' => 'Invitation sent successfully'], 200);
        } else {
            // Create the employee
            $employee = Employee::create($validatedData);
            return response()->json(['message' => 'Employee created successfully', 'employee' => $employee], 201);
        }
    }

    private function sendInvitation($data, $token)
    {
        $to = $data['email_personal']; // Send invitation to personal email
        $subject = 'Invitation to Join';
        $verificationUrl = url('/verify/' . $token); // Adjust URL as needed
        $message = "You have been invited. Please use the following default password to update your password: {$data['defaultPassword']}. Click the following link to verify: {$verificationUrl}";

        Mail::raw($message, function($mail) use ($to, $subject) {
            $mail->to($to)
                 ->subject($subject);
        });
    }

// Handle employee authentication and password update



    public function showResetForm($token)
    {
        $exists = DB::table('invitations')->where('token', $token)->exists();

        if ($exists) {
            return view('employee_reset_form')->with('token', $token);
        } else {
            return  'Invalid token.';
        }
    }

public function employee_authenticate(Request $request)
{
    // Validate the request
    $request->validate([
        'defaultPassword' => 'required|string',
        'newPassword' => 'required|string|min:2',
        'confirm_password' => 'required|string|min:2|same:newPassword'
    ]);

    // Fetch all employees
    $employees = Employee::all();
    foreach ($employees as $employee) {
        if (Hash::check($request->input('defaultPassword'), $employee->defaultPassword)) {
            $employee->defaultPassword = Hash::make($request->input('newPassword'));
            $employee->save();

            return response()->json(['message' => 'Password updated successfully!'], 200);
        }
    }

    return response()->json(['message' => 'The default password is incorrect.'], 400);
}



    // READ ALL EMPLOYEES
    public function getEmployeeAll()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    // SEARCH EMPLOYEES
    public function employee_Search(Request $request)
    {
        $query = $request->input('query');
        if (empty($query)) {
            return response()->json(['message' => 'Query cannot be empty.'], 400);
        }

        $employees = Employee::where('emp_fullname', 'like', "%$query%")
                             ->orWhere('email_personal', $query)
                             ->orWhere('email_company', $query)
                             ->get();

        if ($employees->isEmpty()) {
            return response()->json(['message' => 'No employees found. Please use emp_fullname, email_personal, or email_company to search.'], 404);
        }

        return response()->json($employees);
    }

    // UPDATE AN EMPLOYEE
    public function employee_edit(Request $request)
    {
        $validated = $request->validate([
            'emp_id' => 'required|exists:employeed,emp_id',
            'emp_fullname' => 'required|string|max:255',
            'email_personal' => 'required|email',
            'email_company' => 'required|email',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'defaultPassword' => 'required|string|min:6',
        ]);

        $employee = Employee::where('emp_id', $request->input('emp_id'))->first();
        if ($employee) {
            // Update employee details
            $employee->emp_fullname = $request->input('emp_fullname');
            $employee->email_personal = $request->input('email_personal');
            $employee->email_company = $request->input('email_company');
            $employee->department = $request->input('department');
            $employee->position = $request->input('position');
            $employee->defaultPassword = $request->input('defaultPassword');
            $employee->hod_id = session('hod_id');  // Assuming hod_id is stored in session
            $employee->save();

            return response()->json(['message' => 'Employee updated successfully!']);
        } else {
            return response()->json(['message' => 'Employee not found.'], 404);
        }
    }

    // DELETE AN EMPLOYEE
    public function deleteEmployee(Request $request)
    {
        $validated = $request->validate([
            'emp_id' => 'required|exists:employeed,emp_id',
        ]);

        $employee = Employee::where('emp_id', $request->input('emp_id'))->first();

        if ($employee) {
            $employee->delete();
            return response()->json(['message' => 'Employee deleted successfully!'], 200);
        } else {
            return response()->json(['message' => 'Employee not found.'], 404);
        }
    }
}
