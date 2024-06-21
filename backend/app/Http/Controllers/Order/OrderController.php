<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        return Order::list();
    }

    public function store(Request $request)
    {
        $order = Order::store($request);
        return response()->json($order, 201);
    }

    public function getTotalPrice($id)
    {
        $order = Order::findOrFail($id);
        $totalPrice = $order->calculateTotalPrice();
        return response()->json(['total_price' => $totalPrice], 200);
    }
}
