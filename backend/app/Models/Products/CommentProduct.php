<?php

namespace App\Models\Products;

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
};
