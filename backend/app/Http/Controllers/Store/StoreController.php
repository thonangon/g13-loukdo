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
                'user_id' => 'required|integer',
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

            // Get the authenticated user
            $user = Auth::user();

            // Create new store instance and associate with the user
            $store = new Store([
                'user_id' => 'required|integer',
                'name' => 'required|string|max:255',
                'address' => 'nullable|string',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:204800',
            ]);

            // Save the store to the database
            $store->save();

            // Prepare the response with correct image URL if an image was uploaded
            $store->image_url = $imageName ? asset('/api/stores/image/' . $imageName) : null;

            // Return success response
            return response()->json([
                'status' => true,
                'data' => $store, // Assuming you're returning the store directly
                'message' => 'store created successfully'
            ], 201);
        } catch (\Exception $error) {
            // Return error response if an exception occurs
            return response()->json([
                'status' => false,
                'message' => 'store creation failed',
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

   public function update(Request $request, Store $store)
   {
       try {
           // Validate incoming request
           $validator = Validator::make($request->all(), [
               
           ]);

           // Handle validation errors
           if ($validator->fails()) {
               return response()->json([
                   'status' => false,
                   'message' => 'Validation error',
                   'errors' => $validator->errors()
               ], 422);
           }

           // Handle image update if provided
           if ($request->hasFile('image')) {
               // Delete previous image if exists
               if ($store->image) {
                   Storage::delete('public/stores/' . $store->image);
               }

               // Upload new image
               $file = $request->file('image');
               $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
               $extension = $file->getClientOriginalExtension();
               $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
               $file->storeAs('public/stores', $fileNameToStore); // Store in storage/app/public/stores

               // Update image field in store
               $store->image = $fileNameToStore;
           }

           // Update other fields
           $store->name = $request->name;
           $store->description = $request->description;
           $store->price = $request->price;
           $store->category_id = $request->category_id;

           // Save the updated store
           $store->save();

           // Prepare the response with correct image URL if an image was uploaded
           $store->image_url = $store->image ? asset('storage/stores/' . $store->image) : null;

           // Return success response
           return response()->json([
               'status' => true,
               'data' => new StoreResource($store),
               'message' => 'store updated successfully'
           ]);
       } catch (\Exception $error) {
           // Return error response if an exception occurs
           return response()->json([
               'status' => false,
               'message' => 'store update failed',
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
