<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Employee; 
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assign_to' => 'required|string|max:255', 
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'project_id' => 'required|exists:projects,project_id',
        ];
         

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $employee = Employee::where('emp_fullname', $request->input('assign_to'))->first();

        if (!$employee) {
            return response()->json(['errors' => ['assign_to' => 'Employee not found.']], 404);
        }
         return $request->input('start_date');
        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'assign_to' => $request->input('assign_to'),
            'start_date' => $request->input('start_date'),
            'due_date' => $request->input('due_date'),
            'project_id' => $request->input('project_id'),
            'emp_id' => $employee->emp_id, 
        ]);
        return response()->json(['message' => 'Task created successfully!', 'task' => $task], 201);
    }
}
