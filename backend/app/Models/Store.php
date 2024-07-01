<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id', 'name', 'address', 'description', 'description', 'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function store($request, $id = null){
        $data = $request->only('user_id', 'name', 'address', 'description', 'image');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }

   

    
}
