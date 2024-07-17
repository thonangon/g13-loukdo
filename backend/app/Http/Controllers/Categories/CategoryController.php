<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Exception;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $categories = CategoryResource::collection($categories);
        return response()->json(['data' => $categories, 'message' => 'You can get the categories list'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category_name = $request->category_name;
        $category_image = $request->category_image;

        $category = new Category();
        $category->category_name = $category_name;
        $category->category_image = $category_image;

        try {
            $category->save();
            return response()->json(['data' => $category, 'message' => 'You can store the category'], 200);
        } catch (Exception $error) {
            return response()->json(['data' => $error, 'message' => 'You cannot store the category'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implementation for show method if needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category_name = $request->category_name;
        $category_image = $request->category_image;

        $category = Category::where('id', $id)->first();
        $category->category_name = $category_name;
        $category->category_image = $category_image;

        try {
            $category->save();
            return response()->json(['data' => $category, 'message' => 'You can update the category'], 200);
        } catch (Exception $error) {
            return response()->json(['data' => $error, 'message' => 'You cannot update the category'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::where('id', $id)->first();
        try {
            $category->delete();
            return response()->json(['data' => $category, 'message' => 'You can delete the category'], 200);
        } catch (Exception $error) {
            return response()->json(['data' => $error, 'message' => 'You cannot delete the category'], 400);
        }
    }
}
