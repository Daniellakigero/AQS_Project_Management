<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Employee; 
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

// CREATE TASK

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

// GET ALL TASKS 

 public function tasklist()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

// GET TASK BY ID
public function show($id)
    {
        $task = Task::find($id);
        if ($task) {
            return response()->json($task);
        } else {
            return response()->json(['message' => 'Task not found.'], 404);
        }
    }
// UPDATE TASK
public function update(Request $request, $id)
    {
        
        $rules = [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'assign_to' => 'nullable|string|max:255', 
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'project_id' => 'nullable|exists:projects,project_id',
            'emp_id' => 'nullable|exists:employeed,emp_id',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

   
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found.'], 404);
        }

        $validated = $validator->validated();

    
        if (isset($validated['assign_to'])) {
            $employee = Employee::where('emp_fullname', $validated['assign_to'])->first();

            if (!$employee) {
                return response()->json(['errors' => ['assign_to' => 'Employee not found.']], 404);
            }

            $validated['emp_id'] = $employee->emp_id; 
        }

        $task->update($validated);

        return response()->json(['message' => 'Task updated successfully!', 'task' => $task]);
    }

// DELETE TASK 

 public function delete($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found.'], 404);
        }
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully.'], 200);
    }

}
