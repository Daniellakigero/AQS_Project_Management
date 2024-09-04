<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Hod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    // FORGOT PASSWORD FORM
    public function showForgotPasswordForm()
    {
        return view('forgot-password');
    }

    // SEND PASSWORD RESET LINK
    public function sendResetLink(Request $request)
{
    $request->validate(['email' => 'required|email']);
    
    $email = $request->email;
    $hod = Hod::where('email', $email)->first();

    if ($hod) {
        $token = Str::random(60);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['token' => $token, 'created_at' => now()]
        );
        session(['password_reset_token' => $token]);
        $resetLink = url('/reset-password/' . $token);

        // DEBUGGING USING STORAGE TOOL
        Log::info("Sending password reset email:");
        Log::info("To: $email");
        Log::info("Subject: Password Reset Request");
        Log::info("Body: Click here to reset your password: $resetLink");

      
            Mail::raw("Click here to reset your password: $resetLink", function ($message) use ($email) {
                $message->to($email)->subject('Password Reset Request');
            });

            return  'Password reset link sent!';
    }

    return 'Email not found.';
}


//  SHOWING RESET FORM BY FIRST VERIFYING THE TOKEN
 public function showResetPasswordForm($token)
{
    $sessionToken = session('password_reset_token');

    if ($token === $sessionToken) {
        return view('reset-password', ['token' => $token]);
    }

    return  'Invalid or expired token.';
}


// RESET PASSWORD
public function resetPassword(Request $request)
{

    $request->validate([
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8'
    ]);
    $hod = Hod::where('email', $request->email)->first();

    if ($hod) {
        $hod->password = Hash::make($request->password);
        $hod->save();

        return  'Password has been reset!';
    }

    return 'Email not found.';
}
}
