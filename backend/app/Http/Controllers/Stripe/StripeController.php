<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Http\Resources\StripeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class StripeController extends Controller
{
    public function makePayment(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'amount' => 'required|numeric|min:1',
            // 'payment_method_id' => 'required|string',
        ]);
        // Set your secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Get the amount from the request
        $amount = $request->amount*100;

        try {
            // Create a PaymentIntent to charge a customer
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount, // Amount in cents
                'currency' => 'usd', // Use USD as the currency
                'payment_method_types' => ['card'],
                'description' => 'Example Payment',
            ]);

            // Return client secret to frontend
            return response()->json([
                'status' => true,
                'message' => 'Payment successful.',
                'data' => new StripeResource($paymentIntent)
            ]);
        
        } catch (ApiErrorException $e) {
            // Handle error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    /**
     * Update user's payment status after successful payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
  
    public function confirm(Request $request)
    {
        try {
            // Validate the payment confirmation request
            $validator = Validator::make($request->all(), [
                'payment_id' => 'required|string',
                // Add other required validation rules here
            ]);

            // Handle validation errors
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Get the authenticated user
            /** @var \App\Models\User $user */
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not authenticated',
                ], 401);
            }

            // Here you would typically verify the payment with your payment provider

            // Update the user's post_count and has_paid status
            $user->update([
                'post_count' => 0,
                'has_paid' => 1,
            ]);

            // Return success response
            return response()->json([
                'status' => true,
                'message' => 'Payment confirmed successfully, post count reset and has_paid set to true.'
            ], 200);

        } catch (\Exception $error) {
            // Return error response if an exception occurs
            return response()->json([
                'status' => false,
                'message' => 'Payment confirmation failed',
                'error' => $error->getMessage()
            ], 400);
        }
    }
}

