<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hod;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 
class HodController extends Controller
{
   public function signup(Request $request)
{
    $validator = Validator::make($request->all(), [
        'hod_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:hod',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $hod = HOD::create([
        'hod_name' => $request->hod_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return response()->json(['message' => 'HOD registered successfully', 'hod' => $hod], 201);
}

}
