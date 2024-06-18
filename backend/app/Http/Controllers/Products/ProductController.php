<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json(['data' => ProductResource::collection($products), 'message' => 'Products retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id', 
        ]);

        try {
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->category_id = $request->category_id;

            $product->save();

            return response()->json(['data' => new ProductResource($product), 'message' => 'Product stored successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to store product', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json(['data' => new ProductResource($product), 'message' => 'Product retrieved successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Product not found', 'error' => $e->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            // Add validation rules for other fields like 'price', 'stock', etc.
        ]);

        try {
            $product = Product::findOrFail($id);
            $product->product_name = $request->product_name;
            // Update other attributes as needed

            $product->save();

            return response()->json(['data' => new ProductResource($product), 'message' => 'Product updated successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to update product', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json(['data' => new ProductResource($product), 'message' => 'Product deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to delete product', 'error' => $e->getMessage()], 500);
        }
    }
}
