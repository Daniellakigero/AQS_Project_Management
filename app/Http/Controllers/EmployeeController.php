<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller

{

//  CREATE AN EMPLOYEE

    public function createEmployee(Request $request)
    {
        $validatedData = $request->validate([
            'emp_name' => 'required|string|max:255',
            'email_personal' => 'required|email|max:255',
            'email_company' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'verification_code' => 'required|integer',
        ]);

         $hod_id = session('hod_id');
     
        $validatedData['hod_id'] = $hod_id;
        $employee = Employee::create($validatedData);
        return response()->json(['message' => 'Employee created successfully', 'employee' => $employee], 201);
    }

// READ AN EMPLOYEE BY LIST AND SEARCH

   public function getEmployeeAll(){
       $employees = Employee::all();
       return response()->json($employees);
    }


public function employee_Search(Request $request)
{

    $query = $request->input('query');
    if (empty($query)) {
        return response()->json(['message' => 'Query cannot be empty.'], 400);
    }
    $employees = Employee::where('emp_name', 'like', "%$query%")
                         ->orWhere('email_personal', $query)
                         ->orWhere('email_company', $query)
                         ->get();
    if ($employees->isEmpty()) {
        return response()->json(['message' => 'Please use emp_name, email_personal, or email_company to search.'], 404);
    }

    return response()->json($employees);
    }

// UPDATE AN EMPLOYEE 

public function employee_edit(Request $request)
{
    
    $validated = $request->validate([
        'emp_id' => 'required|exists:employeed,emp_id', // Ensure the table name is correct
        'emp_name' => 'required|string|max:255',
        'email_personal' => 'required|email',
        'email_company' => 'required|email',
        'phone_number' => 'required|string|max:15',
        'verification_code' => 'required|string|max:10',
    ]);

     
    $employee = Employee::where('emp_id', $request->input('emp_id'))->first();
    if ($employee) {
        // Update employee details
        $employee->emp_name = $request->input('emp_name');
        $employee->email_personal = $request->input('email_personal');
        $employee->email_company = $request->input('email_company');
        $employee->phone_number = $request->input('phone_number');
        $employee->verification_code = $request->input('verification_code');
        $employee->hod_id = session('hod_id');
        // return $employee;
        $employee->save();

        return 'Employee updated successfully!';
      } else {
        return 'Employee not found.';
      }
}


// DELETE AN EMPLOYEE 


public function deleteEmployee(Request $request)
{
    $validated = $request->validate([
        'emp_id' => 'required|exists:employeed,emp_id', // Ensure emp_id exists in the database
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


