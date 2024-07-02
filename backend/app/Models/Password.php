<?php

// app/Models/Password.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Password extends Model
{
    protected $fillable = ['email', 'otp', 'expires_at'];

    public static function generateOTP($email)
    {
        $otp = mt_rand(100000, 999999);
        $expires_at = Carbon::now()->addSeconds(60);

        Password::create([
            'email' => $email,
            'otp' => $otp,
            'expires_at' => $expires_at,
        ]);

        return $otp;
    }

    public static function isValidOTP($email, $otp)
    {
        $record = Password::where('email', $email)->where('otp', $otp)->first();

        if ($record && Carbon::now()->lt($record->expires_at)) {
            return true;
        }

        return false;
    }
}
