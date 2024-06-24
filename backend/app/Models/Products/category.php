<?php

<<<<<<< HEAD:backend/app/Models/category.php

namespace App\Models;
=======
namespace App\Models\Products;
>>>>>>> crud_reply_comment:backend/app/Models/Products/category.php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name', 'user_id'];

    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the user that owns the category.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
