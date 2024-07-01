<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $user = User::findOrFail($id);
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'profile' => asset('storage/' . $user->profile),
            'email_verified_at' => $user->email_verified_at,
            'two_factor_confirmed_at' => $user->two_factor_confirmed_at,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]);
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
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
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
            $image_path = asset('/storage'.'/'. $profilePath);
            $user->profile = $profilePath;
            $user->profile_path = $image_path;
          
        }

        $user->save();

        return response()->json([
            'data'=>$user,
            'message' => 'User updated successfully',
            'image_path' => asset('/storage'.'/'. $profilePath),
       
        ], 200);
    }}