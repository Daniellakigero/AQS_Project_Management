<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Hod;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginAuthController extends Controller
{
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $hod = Hod::where('email', $request->email)->first();

    //     if ($hod && Hash::check($request->password, $hod->password)) {
    //         $token = JWTAuth::fromUser($hod);
    //         return response()->json(['message' => 'Login successful', 'token' => $token]);
    //     } else {
    //         return response()->json(['error' => 'Invalid credentials'], 401);
    //     }
    // }
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Find the HOD by email
    $hod = Hod::where('email', $request->email)->first();

    // Compare plain-text passwords
    if ($hod && $request->password === $hod->password) {
        // Generate JWT token
        $token = JWTAuth::fromUser($hod);
        return response()->json(['message' => 'Login successful', 'token' => $token]);
    } else {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}

}
