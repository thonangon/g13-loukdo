<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products\CommentProduct;
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
