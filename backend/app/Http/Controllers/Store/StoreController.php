<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();

        return response()->json([
            'status' => true,
            'data' => StoreResource::collection($stores),
        ]);
    }

    public function store(Request $request)
{
    try {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:204800',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle image upload if provided
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('/api/stores/image/'), $imageName);
        }

        // Get the validated data
        $validatedData = $validator->validated();

        // Create new store instance
        $store = new Store([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'description' => $validatedData['description'],
            'image' => $imageName,
        ]);
        $store->save();
        $store->image_url = $imageName ? asset('/api/stores/image/' . $imageName) : null;
        return response()->json([
            'status' => true,
            'data' => $store,
            'message' => 'Store created successfully'
        ], 201);
    } catch (\Exception $error) {
        // Return error response if an exception occurs
        return response()->json([
            'status' => false,
            'message' => 'Store creation failed',
            'error' => $error->getMessage()
        ], 400);
    }
}


   public function show(Request $request, $id)
   {
       try {
           $store = Store::findOrFail($id); // Ensure store with ID exists
           return response()->json([
               'status' => true,
               'data' => new StoreResource($store),
           ]);
       } catch (\Exception $e) {
           return response()->json([
               'status' => false,
               'message' => 'store not found or an error occurred.',
           ], 404); // Return appropriate HTTP status code
       }
   }
   
   
   public function update(Request $request, $id)
{
    try {
        // Find the store by ID
        $store = Store::findOrFail($id);

        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:30',
            'address' => 'nullable|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:204800',
        ]);

        // Update store properties
        $store->name = $validatedData['name'];
        $store->address = $validatedData['address'];
        $store->description = $validatedData['description'];

        // Handle image update if provided
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($store->image) {
                $imagePath = public_path('/api/stores/image/' . $store->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('/api/stores/image/'), $imageName);

            // Update image field in database
            $store->image = $imageName;
        }

        // Save updated store
        $store->save();

        // Optionally, update image_url if needed
        $store->image_url = $store->image ? asset('/api/stores/image/' . $store->image) : null;

        return response()->json([
            'status' => true,
            'data' => $store,
            'message' => 'Store updated successfully'
        ]);
    } catch (\Exception $error) {
        // Log the error message
        Log::error('Store update failed: ' . $error->getMessage());

        // Return error response if an exception occurs
        return response()->json([
            'status' => false,
            'message' => 'Store update failed',
            'error' => $error->getMessage()
        ], 400);
    }
}


    public function destroy($id)
    {
        try {
            // Find the store by ID
            $store = Store::findOrFail($id);

            // Logging the store details before deletion
            Log::info('Deleting store: ', $store->toArray());

            // Delete associated image from storage if it exists
            if ($store->image) {
                $imagePath = public_path('/api/stores/image/' . $store->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Delete the st$store
            $store->delete();

            // Return success response
            return response()->json([
                'status' => true,
                'message' => 'Product and associated image deleted successfully'
            ]);
        } catch (\Exception $error) {
            // Log the error message
            Log::error('Product deletion failed: ' . $error->getMessage());

            // Return error response if an exception occurs
            return response()->json([
                'status' => false,
                'message' => 'Product deletion failed',
                'error' => $error->getMessage()
            ], 400);
        }
    }
    public function getImage($id)
    {
        try {
            $product = Store::findOrFail($id);

            if ($product->image) {
                $path = public_path('/api/products/image/' . $product->image);
                return Response::file($path);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Image not found for product with ID ' . $id,
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error retrieving image: ' . $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Retrieve ratings for a specific product.
     *
     * @param  int  $productId
     * @return \Illuminate\Http\JsonResponse
     */
    
}
