<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
class TeamController extends Controller
{
    // CREATE  A TEAM
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
}
