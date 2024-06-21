<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'order_date',
    ];
    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot('qty');
    }

    public static function list()
    {
        return self::all();
    }
    public static function store($request, $id = null)
{
    $data = $request->only('user_id', 'order_date');
    $order = self::updateOrCreate(['id' => $id], $data);

    if ($request->has('products')) {
        $products = collect($request->products)->mapWithKeys(function ($product) {
            return [$product['product_id'] => ['qty' => $product['qty']]];
        });
        $order->products()->sync($products);
    }

    return $order;
}
    public function calculateTotalPrice(){
        $total=0;
        foreach($this->products as $product){
            $total += $product->price * $product->pivot->qty;
        }
        return $total;
    }
}
