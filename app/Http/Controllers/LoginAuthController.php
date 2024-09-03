<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Hod;

class LoginAuthController extends Controller
{
   public function login(Request $request)
{

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

  
    $hod = Hod::where('email', $request->email)->first();

    if ($hod) {
        $hashedPassword = $hod->password;
        $plainPassword = $request->password;
        if (Hash::check($plainPassword, $hashedPassword)) {
            session([
                'hod_id' => $hod->hod_id,
                'hod_name' => $hod->hod_name
            ]);
            return redirect()->intended('dashboard'); 
        } else {
            return redirect()->back()
                ->withErrors(['email' => 'Invalid credentialskkkk.'])
                ->withInput();
        }
    } else {
        return redirect()->back()
            ->withErrors(['email' => 'Invalid credentials.'])
            ->withInput();
    }
}
}