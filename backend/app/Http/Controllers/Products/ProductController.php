<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Products\Product;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $products = Product::with('category')->get();
            return response()->json(['status' => true, 'data' => ProductResource::collection($products), 'message' => 'Product list retrieved successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to retrieve product list', 'error' => $e->getMessage()], 500);
        }
        // try {
        //     $products = Product::with('category')->get();

        //     $data = $products->map(function ($product) {
        //         return [
        //             'id' => $product->id,
        //             'name' => $product->name,
        //             'description' => $product->description,
        //             'price' => $product->price,
        //             'stock' => $product->stock,
        //             'image' => $product->image,
        //             'category_id' => $product->category_id,
        //             'category_name' => $product->category->category_name,
        //             // 'created_at' => Carbon::parse($product->created_at)->isoFormat('dddd Do, MMMM, YYYY [at] h:mm:ss'),
        //             // 'updated_at' => Carbon::parse($product->updated_at)->isoFormat('dddd Do, MMMM, YYYY [at] h:mm:ss')
        //             'created_at' => $product->created_at,
        //             'updated_at' => $product->updated_at
        //         ];
        //     });

        //     return response()->json(['status' => true, 'data' => $data, 'message' => 'Product list retrieved successfully'], 200);
        // } catch (Exception $e) {
        //     return response()->json(['status' => false, 'message' => 'Failed to retrieve product list', 'error' => $e->getMessage()], 500);
        // }
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->category_id = $request->category_id;

            if ($request->hasFile('image')) {
                $imageName = time().'.'.$request->image->extension();
                $request->image->storeAs('images', $imageName, 'public');
                $product->image = $imageName;
            }

            $product->save();

            return response()->json(['status' => true, 'data' => $product, 'message' => 'Product stored successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to store product', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // try {
        //     $product = Product::with('category')->findOrFail($id);
        //     $data = [
        //         'id' => $product->id,
        //         'name' => $product->name,
        //         'description' => $product->description,
        //         'price' => $product->price,
        //         'stock' => $product->stock,
        //         'image' => $product->image,
        //         'category_id' => $product->category_id,
        //         'category_name' => $product->category->name,
        //         'created_at' => Carbon::parse($product->created_at)->isoFormat('dddd Do, MMMM, YYYY [at] h:mm:ss'),
        //         'updated_at' => Carbon::parse($product->updated_at)->isoFormat('dddd Do, MMMM, YYYY [at] h:mm:ss')
        //     ];
        //     return response()->json(['status' => true, 'data' => $data, 'message' => 'Product retrieved successfully'], 200);
        // } catch (Exception $e) {
        //     return response()->json(['status' => false, 'message' => 'Product not found', 'error' => $e->getMessage()], 404);
        // }

        try {
            $product = Product::with('category')->findOrFail($id);
            return response()->json(['status' => true, 'data' => new ProductResource($product), 'message' => 'Product retrieved successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Product not found', 'error' => $e->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
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
            $product = Product::findOrFail($id);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->category_id = $request->category_id;

            if ($request->hasFile('image')) {
                // Delete the old image if exists
                if ($product->image) {
                    Storage::disk('public')->delete('images/'.$product->image);
                }

                $imageName = time().'.'.$request->image->extension();
                $request->image->storeAs('images', $imageName, 'public');
                $product->image = $imageName;
            }

            $product->save();

            return response()->json(['status' => true, 'data' => $product, 'message' => 'Product updated successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to update product', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            if ($product->image) {
                Storage::disk('public')->delete('images/'.$product->image);
            }

            $product->delete();
            return response()->json(['status' => true, 'data' => $product, 'message' => 'Product deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to delete product', 'error' => $e->getMessage()], 500);
        }
    }
}
