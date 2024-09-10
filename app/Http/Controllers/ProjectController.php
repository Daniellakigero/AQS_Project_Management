<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Project;

class ProjectController extends Controller
{


//  CREATE PROJECT
    public function create(Request $request)
    {
    $validatedData = $request->validate([
    'project_name' => 'required|string|max:255',
    'project_description' => 'nullable|string',
    'project_file' => 'nullable|file|mimes:pdf,txt|max:2048',
    'project_category' => 'required|string|max:255',
    'client' => 'required|string|max:255',
    ]);

        // GET AUTHENTICATED USER
        $user = JWTAuth::parseToken()->authenticate();
        $hod_id = $user->hod_id; 
        $filePath = null;
        if ($request->hasFile('project_file')) {
            $file = $request->file('project_file');
            $filePath = $file->store('project_files', 'public');
        }

        $project = Project::create([
            'project_name' => $request->input('project_name'),
            'project_description' => $request->input('project_description'),
            'project_file' => $filePath, 
            'project_category' => $request->input('project_category'),
            'client' => $request->input('client'),
            'hod_id' => $hod_id,
        ]);
\Log::info('Greate');
        return response()->json(['success' => 'Project created successfully!', 'project' => $project], 201);
    }

// READ ALL PROJECTS
  public function get_all()
    {
        $projects = Project::all();
        return response()->json(['projects' => $projects], 200);
    }
// GET A PROJECT BY ID

  public function show($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        return response()->json(['project' => $project], 200);
    }

// DELETE A PROJECT BY ID
public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        if ($project->project_file) {
            \Storage::disk('public')->delete($project->project_file);
        }

        $project->delete();

        return response()->json(['success' => 'Project deleted successfully!'], 200);
    }


// UPDATE A PROJECT BY ID



public function update(Request $request, $id)
{
    // Log incoming request data
    \Log::info('Incoming request data:', $request->all());

    // Validate incoming request
    $validatedData = $request->validate([
        'project_name' => 'nullable|string|max:255',
        'project_description' => 'nullable|string',
        'project_file' => 'nullable|file|mimes:pdf,txt|max:2048',
        'project_category' => 'nullable|string|max:255',
        'client' => 'nullable|string|max:255',
    ]);
    return  $validatedData;   // Log the validated data
    \Log::info('Validated update project data:', $validatedData);
}







}

