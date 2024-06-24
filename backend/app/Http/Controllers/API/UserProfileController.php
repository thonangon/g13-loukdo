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
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for profile image
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile')) {
            // Delete the old profile image if it exists
            if ($user->profile) {
                Storage::disk('public')->delete($user->profile);
            }

            // Store the new profile image
            $profilePath = $request->file('profile')->store('profiles', 'public');
            $user->profile = $profilePath;
        }

        $user->save();

        return response()->json([
            'message' => 'User updated successfully',
        ], 200);
    }
}
