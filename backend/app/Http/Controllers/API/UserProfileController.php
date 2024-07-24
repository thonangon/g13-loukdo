<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\userproductresource;

class UserProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $user_id = auth()->id();
        $user = User::findOrFail($user_id);
        try{
            return response()->json(['user' => $user,'message' => 'You can see your profile'], status:200);
        }catch(\Exception $e){
            return response()->json(['message'=> $e->getMessage()], status:500);
        }
        
    }
    public function userproduct(Request $request){
        $user_id = $request->id;
        $user = User::findOrFail($user_id);
        try{
            return response()->json(['data'=> userproductresource::make($user),'message'=> 'get all users product', 'status'=>200]);
        }catch(\Exception $e){
            return response()->json(['message'=> $e->getMessage()], status:500);
        }
    }
    public function userStore(Request $request){
        $user_id = $request->id;
        $user = User::findOrFail($user_id);
        try{
            return response()->json(['data'=> StoreResource::make($user),'message'=> 'get all  store of user', 'status'=>200]);
        }catch(\Exception $e){
            return response()->json(['message'=> $e->getMessage()], status:500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $user_id = Auth()->id();
        $user = User::find($user_id);

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user_id,
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'user_qrimage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update user details
        if ($request->name == null || $request->email == null)
        {
            $user->name = $user->name;
            $user->email = $user->email;
        }else{
            $user->name = $request->name;
            $user->email = $request->email;
        }

        if ($request->hasFile('profile')) {
            // Delete the old profile image if it exists
            if ($user->profile) {
                Storage::disk('public')->delete($user->profile);
            }

            // Store the new profile image
            $profilePath = $request->file('profile')->store('profiles', 'public');
            $user->profile = $profilePath;

          
        }
        if ($request->hasFile('user_qrimage')) {
            // Store the new profile image
            $userqr_image = $request->file('user_qrimage')->store('userqrimage', 'public');
            // add something
            $user->user_qrimage = $userqr_image;
        }

        $user->save();

        return response()->json([
            'data'=>$user,
            'message' => 'User updated successfully',
       
        ], 200);
    }}