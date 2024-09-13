<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class EmployeeController extends Controller
{

    
// CREATE EMPLOYEE WITH SENT RESET LINK
public function create_employee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emp_fullname' => 'required|string|max:255',
            'email_company' => 'required|email|unique:employeed,email_company',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'defaultPassword' => 'required|string|size:6',
            'email_personal' => 'nullable|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();
        \Log::info('Validated data:', ['data' => $validatedData]);
        $user = JWTAuth::parseToken()->authenticate();
        $hod_id = $user->hod_id;

         $employee = Employee::create([
        'emp_fullname' => $validatedData['emp_fullname'],
        'email_company' => $validatedData['email_company'],
        'department' => $validatedData['department'],
        'position' => $validatedData['position'],
        'defaultPassword' => $validatedData['defaultPassword'], // No Hash::make()
        'email_personal' => $validatedData['email_personal'],
        'hod_id' => $hod_id,
    ]);
        \Log::info('Employee created:', ['employee' => $employee]);

        $token = Str::random(60);

        Invitation::create([
            'email_personal' => $employee->email_personal,
            'token' => $token,
        ]);


        $this->sendInvitation($employee->email_personal, $token, $request->defaultPassword);

        $employee->update([
            'processed' => true,
            'verified' => false,
        ]);

        return response()->json([
            'message' => 'Employee created, invitation sent, and status updated successfully',
            'employee' => $employee
        ], 201);
    }


    private function sendInvitation($email, $token, $defaultPassword)
    {
        $subject = 'Invitation to Join';
        $verificationUrl = url('/verify/' . $token); 
        $message = "You have been invited. Please use the following default password to update your password: {$defaultPassword}. Click the following link to verify: {$verificationUrl}";

        Mail::raw($message, function($mail) use ($email, $subject) {
            $mail->to($email)
                 ->subject($subject);
        });
    }

// EMPLOYEE DEFAULT_PASSWORD VERIFY
public function employee_verify(Request $request)
{
  $rules = [
        'defaultPassword' => 'required|string|size:6',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 400);
    }
 
    $hashedPasswords = Employee::pluck('defaultPassword');
    foreach ($hashedPasswords as $hashedPassword) {
        if (Hash::check($request->input('defaultPassword'), $hashedPassword)) {
            return response()->json(['message' => 'Password Verified!'], 200);
        }
    }
    return response()->json(['message' => 'The default password is incorrect.'], 400);
}


// EMPLOYEE AUTHENTICATE
public function employee_authenticate(Request $request)
{

    $request->validate([
        'defaultPassword' => 'required|string',
        'newPassword' => 'required|string|size:6',
        'confirm_password' => 'required|string|size:6|same:newPassword'
    ]);

    $employees = Employee::all();
    foreach ($employees as $employee) {
        if (Hash::check($request->input('defaultPassword'), $employee->defaultPassword)) {
            $employee->defaultPassword = $request->input('newPassword');
            $employee->verified = true;
            $employee->save();

            return response()->json(['message' => 'Password verified successfully!'], 200);
        }
    }

    return response()->json(['message' => 'The default password to be verified is incorrect.'], 400);
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
   

public function employee_edit(Request $request, $id)
{
    $rules = [
        'emp_fullname' => 'required|string|max:255',
        'email_personal' => 'required|email',
        'email_company' => 'required|email',
        'department' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'defaultPassword' => 'required|string|min:6', 
        'processed' => 'required|boolean',
        'verified' => 'required|boolean',
    ];


    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $validated = $validator->validated();

    $employee = Employee::find($id);
    $user = JWTAuth::parseToken()->authenticate();
    $hod_id = $user->hod_id;

    if ($employee) {
        $employee->emp_fullname = $validated['emp_fullname'];
        $employee->email_personal = $validated['email_personal'];
        $employee->email_company = $validated['email_company'];
        $employee->department = $validated['department'];
        $employee->position = $validated['position'];
        $employee->defaultPassword = $validated['defaultPassword']; 
        $employee->processed = $validated['processed'];
        $employee->verified = $validated['verified'];
        $employee->hod_id = $hod_id; 
        $employee->save();

        return response()->json(['message' => 'Employee updated successfully!']);
    } else {
        return response()->json(['message' => 'Employee not found.'], 404);
    }
}


    // DELETE AN EMPLOYEE
    public function deleteEmployee($id)
    {
        
        $employee = Employee::find($id);
        if ($employee) {
            $employee->delete();
            return response()->json(['message' => 'Employee deleted successfully!'], 200);
        } else {
            return response()->json(['message' => 'Employee not found.'], 404);
        }
    }


// EMPLOYEE LOGIN
public function employee_login(Request $request)
{
    $request->validate([
        'email_company' => 'required|email',
        'defaultPassword' => 'required|string|size:6',
    ]);

    $employee = Employee::where('email_company', $request->input('email_company'))
                        ->where('processed', true)
                        ->where('verified', true)
                        ->first();

    if (!$employee) {
        return response()->json(['message' => 'Employee not found or not verified.'], 404);
    }

    if (Hash::check($request->input('defaultPassword'), $employee->defaultPassword)) {
        $token = JWTAuth::fromUser($employee);

        return response()->json([
            'message' => 'Login successful!',
            'token' => $token,
            'employee' => $employee
        ], 200);
    } else {
        return response()->json(['message' => 'Invalid credentials.'], 401);
    }
}

}
