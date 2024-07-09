<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id', 'name', 'address','description', 'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
