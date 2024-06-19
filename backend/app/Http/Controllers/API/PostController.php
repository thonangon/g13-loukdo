<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        try {
            $products = Post::with('category', 'user')->get();
            return response()->json([
                'status' => true,
                'data' => PostResource::collection($products),
                'message' => 'Product list retrieved successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to retrieve product list', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $product = new Post();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->category_id = $request->category_id;
            $product->user_id = Auth::id();

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads'), $imageName);
                $product->image = $imageName;
            }

            $product->save();

            return response()->json([
                'status' => true,
                'data' => new PostResource($product),
                'message' => 'Product stored successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to store product', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $product = Post::with('category', 'user')->findOrFail($id);
            return response()->json([
                'status' => true,
                'data' => new PostResource($product),
                'message' => 'Product retrieved successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Product not found', 'error' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $product = Post::findOrFail($id);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->category_id = $request->category_id;

            if ($request->hasFile('image')) {
                // Delete the old image if exists
                if ($product->image) {
                    Storage::disk('public')->delete('uploads/' . $product->image);
                }

                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads'), $imageName);
                $product->image = $imageName;
            }

            $product->save();

            return response()->json([
                'status' => true,
                'data' => new PostResource($product),
                'message' => 'Product updated successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to update product', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Post::findOrFail($id);

            if ($product->image) {
                Storage::disk('public')->delete('uploads/' . $product->image);
            }

            $product->delete();
            return response()->json([
                'status' => true,
                'data' => new PostResource($product),
                'message' => 'Product deleted successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to delete product', 'error' => $e->getMessage()], 500);
        }
    }
}

