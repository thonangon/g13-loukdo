<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Http\Resources\StripeResource;
use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class StripeController extends Controller
{
    public function makePayment(Request $request)
    {
        // Set your secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // dd($request->amount);
        try {
            // Create a PaymentIntent to charge a customer
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount*100, // Example amount in cents
                'currency' => 'usd',
                'payment_method_types' => ['card'],
                'description' => 'Example Payment',
            ]);

            // Return client secret to frontend
            return response()->json(['clientSecret' => $paymentIntent->client_secret]);
        } catch (ApiErrorException $e) {
            // Handle error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function handlePaymentSuccess(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'payment_intent_id' => 'required|string',
            'id' => 'required|exists:users,id', // Ensure the user_id exists in the users table
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Set your secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        try {
            // Retrieve the PaymentIntent
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);
            
            // Check if payment was successful
            if ($paymentIntent->status === 'succeeded') {
                // Find the user
                $user = User::find($request->id);

                if ($user) {
                    $postLimit = 10; // Define your post limit

                    // Reset post_count to 0 and set has_paid to 1 if user has made the payment
                    if ($user->post_count >= $postLimit) {
                        $user->post_count = 0;
                        $user->has_paid = 1;
                        $user->save();

                        return response()->json([
                            'status' => true,
                            'message' => 'Payment confirmed. Post count reset and user can post new products.',
                            'data' => new StripeResource($paymentIntent),
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'User has not reached the post limit.',
                        ], 400);
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'User not found.',
                    ], 404);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Payment not successful.',
                ], 400);
            }
        } catch (ApiErrorException $e) {
            // Handle error
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while confirming the payment.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
