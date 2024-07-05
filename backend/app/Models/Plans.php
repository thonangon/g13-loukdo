<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plans extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'plan',
        'starts_at',
        'ends_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }
    public static function store($request, $id = null)
    {
        $data = $request->only('name','slug','price','description',);
        $data= self::updateOrCreate(['id'=>$id],$data);
        return $data;
    }
}
