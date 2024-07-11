<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use App\Http\Resources\StripeResource;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StripePaymentController extends Controller
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
            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
            ]);
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
            'user_id' => 'required|exists:users,id',
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
        $user= Auth::user();
        try {
            // Retrieve the PaymentIntent
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);

            if ($paymentIntent->status == 'requires_payment_method') {
                // Find the user and reset their post count
                $user = User::find($request->user_id);
                $user->post_count = 0;
                $user->has_paid = 1;
                $user->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Payment successful and post count reset.',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Payment not successful.',
                    'payment_intent_status' => $paymentIntent->status,
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
