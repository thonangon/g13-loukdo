<?php

namespace App\Models;

use App\Models\CommentProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class replyComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'comment_id',
        'text',
    ];

    public function CommentProduct(){
        return $this->belongsTo(CommentProduct::class);
    }
}
