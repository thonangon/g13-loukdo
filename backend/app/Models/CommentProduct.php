<?php

namespace App\Models;

use App\Models\replyComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'comment',
        'image'
    ];

    public function replyComment(){
        return $this->hasMany(replyComment::class);
    }
};
