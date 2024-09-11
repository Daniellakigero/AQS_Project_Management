<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Hod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class PasswordResetController extends Controller
{

    public function sendResetLink(Request $request)
{
    $request->validate(['email' => 'required|email']);
    
    $email = $request->email;
    $hod = Hod::where('email', $email)->first();

    if ($hod) {
        try {
            $token = JWTAuth::claims(['email' => $hod->email])->fromUser($hod);
            $resetLink = url('/reset-password/' . $token);

            // DEBUGGING USING STORAGE TOOL
            Log::info("Sending password reset email:");
            Log::info("To: $email");
            Log::info("Subject: Password Reset Request");
            Log::info("Body: Click here to reset your password: $resetLink");

          
            Mail::raw("Click here to reset your password: $resetLink", function ($message) use ($email) {
                $message->to($email)->subject('Password Reset Request');
            });
            return response()->json([
                'message' => 'Password reset link sent!',
                'token' => $token
            ]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to create token.'], 500);
        }
    }

    return response()->json(['error' => 'Email not found.'], 404);
}


    // RESET PASSWORD
 public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|confirmed|min:3',
        'token' => 'required'
    ]);

    $email = $request->email;
    $token = $request->token;

    try {
        $payload = JWTAuth::setToken($token)->getPayload();
        $tokenEmail = $payload->get('email'); 

        if ($email !== $tokenEmail) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        $hod = Hod::where('email', $email)->first();

        if ($hod) {
            $hod->password = Hash::make($request->password);
            $hod->save();

            return response()->json(['message' => 'Password has been reset!']);
        }

        return response()->json(['error' => 'Email not found.'], 404);

    } catch (JWTException $e) {
        return response()->json(['error' => 'Invalid or expired token.'], 400);
    }
  }

}
