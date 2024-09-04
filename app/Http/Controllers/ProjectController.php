<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class ProjectController extends Controller
// {
//     public function createProject(Request $request)
//     {
//         $validatedData = $request->validate([
//             'project_name' => 'required|string|max:255',
//             'description' => 'required|string',
//             'start_date' => 'required|date',
//             'end_date' => 'nullable|date',
//             'status' => 'required|string',
//             'created_by' => 'required|exists:employeed,emp_id',
//         ]);

//          $hod_id = session('hod_id');
//          $emp_id = session('emp_id');
//          $validatedData['hod_id'] = $hod_id;
//          $validatedData['emp_id'] = $emp_id;
//         // return response()->json($validatedData);
//         $project = Project::create($validatedData);

//         // Return a response (can be a view or JSON response)
//         return response()->json(['message' => 'Project created successfully', 'project' => $project], 201);
//     }
// }


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Employee;

class ProjectController extends Controller
{
    public function create()
    {
        $employees = Employee::all(); // Retrieve all employees
        return view('projects.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'status' => 'required|string',
            'assign_to' => 'required|array',
            'assign_to.*' => 'exists:employeed,emp_id',
        ]);

        $hod_id = session('hod_id');
        $validatedData['hod_id'] = $hod_id;

        // Create the project
        $project = Project::create($validatedData);

        // Attach employees to the project
        $project->employees()->attach($request->assign_to);

        return redirect()->route('projects.index')
            ->with('success', 'Project created and assigned to employees successfully');
    }
}

  