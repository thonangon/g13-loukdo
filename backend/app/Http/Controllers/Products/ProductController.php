<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Exception;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::all();
            return response()->json(['status' => true, 'data' => ProductResource::collection($products), 'message' => 'Product list retrieved successfully'], 200);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'message' => 'Failed to retrieve product list', 'error' => $error->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products', // Ensure product name is unique in products table
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|file|max:10240', // max 10MB for all types of files
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('uploads/products', $fileName, 'public');
            } else {
                $filePath = null;
            }

            // Create new product
            $product = new Product([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $filePath,
                'category_id' => $request->category_id,
                'user_id' => $request->user_id,
            ]);

            $product->save();

            // Prepare the response with correct image URL
            if ($filePath) {
                $product->image = Storage::url($filePath);
            }

            return response()->json([
                'status' => true,
                'data' => new ProductResource($product),
                'message' => 'Product created successfully'
            ], 201);
        } catch (Exception $error) {
            return response()->json([
                'status' => false,
                'message' => 'Product creation failed',
                'error' => $error->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json(['status' => true, 'data' => new ProductResource($product), 'message' => 'Product retrieved successfully'], 200);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'message' => 'Product not found', 'error' => $error->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $id, // Ensure product name is unique except for the current product
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|file|max:10240', // max 10MB for all types of files
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            $product = Product::findOrFail($id);

            // Handle image update
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('uploads/products', $fileName, 'public');

                // Delete old image if it exists
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }

                $product->image = $filePath;
            }

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->user_id = $request->user_id;

            $product->save();

            // Prepare the response with correct image URL
            if ($product->image) {
                $product->image = Storage::url($product->image);
            }

            return response()->json([
                'status' => true,
                'data' => new ProductResource($product),
                'message' => 'Product updated successfully'
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'status' => false,
                'message' => 'Product update failed',
                'error' => $error->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);

            // Delete associated image file if it exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();

            return response()->json(['status' => true, 'message' => 'Product deleted successfully'], 200);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'message' => 'Product deletion failed', 'error' => $error->getMessage()], 400);
        }
    }
}
