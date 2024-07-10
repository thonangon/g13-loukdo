<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles; // Include HasRoles trait for roles and permissions

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'post_count',
        'has_paid'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    protected $attributes = [
        'post_count' => 0,
        'has_paid' => 0,
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }




        // Define relationship with Category
        public function category()
        {
            return $this->belongsTo(Category::class);
        }

        // Define relationship with User

        public function comments()
        {
            return $this->hasMany(CommentProduct::class);
        }
    
        public function replies()
        {
            return $this->hasMany(ReplyComment::class);
        }
        public function plan()
    {
        return $this->hasOne(Plans::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
        
}
