<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
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
        // return response()->json($validatedData);
        $employee = Employee::create($validatedData);

        // Return a response (can be a view or JSON response)
        return response()->json(['message' => 'Employee created successfully', 'employee' => $employee], 201);
    }
}
