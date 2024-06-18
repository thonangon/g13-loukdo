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
        $category = Category::all();
        $category = CategoryResource::collection($category);
        return response()->json(['data' => $category, 'message' => 'You can get the categories list'], status:200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $category_name= $request->category_name;
        $category = new Category();

        $category->category_name = $category_name;
        try {
            $category->save();
            return response()->json(['data' => $category, 'message' => 'You can store the category'], status:200);
        }catch(Exception $error){
            return response()->json(['data' => $error, 'message' => 'You can not store the category'], status:400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id =$request->id;
        $category_name= $request->category_name;

        $category = Category::where('id',$id)->first();

        $category->category_name = $category_name;
        try {
            $category->save();
            return response()->json(['data' => $category, 'message' => 'You can update the category'], status:200);
        }catch(Exception $error){
            return response()->json(['data' => $error, 'message' => 'You can not update the category'], status:400);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
