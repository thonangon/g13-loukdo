<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'otp',
        'expires_at',
    ];

    public $timestamps = false;

    // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
