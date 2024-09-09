<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    // CREATE A TEAM
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'id_number' => 'required|string|max:255|unique:teams,id_number',
            'nationality' => 'required|string|max:255',
            'email' => 'required|email|unique:teams,email',
            'gender' => 'required|in:male,female,other',
        ]);
      
        Team::create($validatedData);
        return redirect()->back()->with('success', 'Team member created successfully!');
    }
    // READ A TEAM MEMBER
     public function read()
    {
        $teams = Team::all();
        return response()->json($teams);
    }
    // READ A TEAM MEMBER BY ID
     public function show($id)
    {
        $team = Team::findOrFail($id);
        return response()->json($team);
    }


    // UPDATE A TEAM MEMBER
    public function edit(Request $request)
    {
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,team_id',
            'fullname' => 'required|string|max:255',
            'id_number' => 'required|string|unique:teams,id_number,' . $request->input('team_id') . ',team_id',
            'nationality' => 'required|string|max:255',
            'email' => 'required|email|unique:teams,email,' . $request->input('team_id') . ',team_id',
            'gender' => 'required|in:male,female,other',
        ]);
        
        $team = Team::where('team_id', $request->input('team_id'))->first();

        if ($team) {
            $team->fullname = $request->input('fullname');
            $team->id_number = $request->input('id_number');
            $team->nationality = $request->input('nationality');
            $team->email = $request->input('email');
            $team->gender = $request->input('gender');
            // return  $team;
            $team->save();

        return response()->json(['message' => 'Team member updated successfully!']);
        } else {
            return response()->json(['message' => 'Team member not found.'], 404);
        }
    }

     // DELETE A TEAM MEMBER
     public function delete(Request $request)
     {
         // Validate the request data
         $validated = $request->validate([
             'team_id' => 'required|exists:teams,team_id',
         ]);
 
         // Find the team member by team_id
         $team = Team::where('team_id', $request->input('team_id'))->first();
 
         if ($team) {
             // Delete the team member
             $team->delete();
             return response()->json(['message' => 'Team member deleted successfully!'], 200);
         } else {
             // If the team member is not found, return an error response
             return response()->json(['message' => 'Team member not found.'], 404);
         }
     }
}
