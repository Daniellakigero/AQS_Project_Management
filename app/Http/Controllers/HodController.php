<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Hod;

// class HodController extends Controller
// {
//     public function store(Request $request)
//     {
//         // Validate the request
//         $validatedData = $request->validate([
//             'first_name' => 'required|string|max:255',
//             'last_name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:hod,email',
//             'password' => 'required|string|min:8',
//         ]);

//         // Combine first and last names to create the full name
//         $fullName = $validatedData['first_name'] . ' ' . $validatedData['last_name'];

//         // Create a new HOD
//         Hod::create([
//             'hod_name' => $fullName,
//             'email' => $validatedData['email'],
//             'password' => $validatedData['password'],
//         ]);

//         // Redirect or return a response
//         return redirect()->route('hod.signup.form')->with('success', 'HOD successfully registered!');
//     }
// }


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hod;

class HodController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:hod,email',
            'password' => 'required|string|min:8',
        ]);

        // Combine first and last names to create the full name
        $fullName = $validatedData['first_name'] . ' ' . $validatedData['last_name'];

        // Create a new HOD
        Hod::create([
            'hod_name' => $fullName,
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ]);

        // Redirect or return a response
        return redirect()->route('hod.signup.form')->with('success', 'HOD successfully registered!');
    }
}
