<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OTPController extends Controller
{
    public function forgotPassword(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $otp = random_int(100000, 999999);
        $token = Str::random(60);

        PasswordReset::updateOrCreate(
            ['email' => $user->email],
            ['token' => $token, 'otp' => $otp, 'expires_at' => Carbon::now()->addSeconds(60)]
        );

        // Example of sending OTP via email
        // Make sure to customize this based on your actual email template and configuration
        Mail::to($user->email)->send(new \App\Mail\SendOtpMail($otp));

        return response()->json(['message' => 'OTP sent to your email']);
    }

    public function verifyOtp(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|integer',
        ]);

        $record = PasswordReset::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$record) {
            return response()->json(['message' => 'Invalid or expired OTP'], 400);
        }

        // Optionally, you can extend the expiry time here if needed
        // $record->expires_at = Carbon::now()->addSeconds(60);
        // $record->save();

        return response()->json(['message' => 'OTP verified', 'token' => $record->token]);
    }

    // Remaining methods (resetPassword) remain unchanged
    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $record = PasswordReset::where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return response()->json(['message' => 'Invalid or expired token'], 400);
        }

        $user = User::where('email', $record->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        $record->delete();

        return response()->json(['message' => 'Password reset successfully']);
    }
}
