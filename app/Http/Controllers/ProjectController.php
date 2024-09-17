<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProjectController extends Controller
{


//  CREATE PROJECT
    public function create(Request $request)
    {
\Log::info('Request data:', ['request' => $request->all()]);
\Log::info('Files received:', ['files' => $request->file()]);

    $validatedData = $request->validate([
    'project_name' => 'nullable|string|max:255',
    'project_description' => 'nullable|string',
    'project_file' => 'nullable|file|mimes:pdf,txt|max:2048',
    'project_category' => 'nullable|string|max:255',
    'client' => 'nullable|string|max:255',
    ]);

\Log::info('Request data:', ['data' => $validatedData]);

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


// UPDATE PROJECT
public function update(Request $request, $id)
{
    \Log::info('Headers:', ['headers' => $request->headers->all()]);
    \Log::info('Request data:', ['request' => $request->all()]);
    \Log::info('Files received:', ['files' => $request->file()]);

    $validatedData = $request->validate([
        'project_name' => 'nullable|string|max:255',
        'project_description' => 'nullable|string',
        'project_file' => 'nullable|file|mimes:pdf,txt|max:2048',
        'project_category' => 'nullable|string|max:255',
        'client' => 'nullable|string|max:255',
    ]);

    $hod = JWTAuth::parseToken()->authenticate();

    if (!$hod) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $project = Project::where('project_id', $id)
                      ->where('hod_id', $hod->hod_id)
                      ->first();

    if (!$project) {
        return response()->json(['error' => 'Project not found or not authorized'], 404);
    }

    $project->update($validatedData);
    \Log::info('Project updated:', ['project_id' => $id, 'data' => $validatedData]);

    return response()->json([
        'message' => 'Project updated successfully',
        'project' => $project
    ]);
}


}

