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
      
        Stripe::setApiKey(env('STRIPE_SECRET'));
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
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);

            if ($paymentIntent->status == 'succeeded') {
                $user = User::where('email', $request->email)->first();

                if ($user) {
                    // Update user's post count and has_paid flag
                    $user->post_count = 0;
                    $user->has_paid = true;
                    $user->save();

                    return response()->json([
                        'status' => true,
                        'message' => 'Payment successful. Post count reset for user.',
                    ]);
                }
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
