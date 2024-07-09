<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use App\Models\User;


class StripeController extends Controller
{
    public function makePayment(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);
        // Set your secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Get the amount from the request
        $amount = $request->amount;

        try {
            // Create a PaymentIntent to charge a customer
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount, // Amount in cents
                'currency' => 'usd', // Use USD as the currency
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
    /**
     * Update user's payment status after successful payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePaymentStatus(Request $request)
    {
        try {
            // Get the authenticated user
            $user = Auth::user();

            // Update user's payment status
            $user->has_paid = true;
            $user->post_count = 0; // Reset post_count to 0
            // $user->save();

            return response()->json([
                'status' => true,
                'message' => 'User payment status updated successfully.',
            ]);
        } catch (\Exception $error) {
            // Return error response if an exception occurs
            return response()->json([
                'status' => false,
                'message' => 'Failed to update user payment status',
                'error' => $error->getMessage(),
            ], 500);
        }
    }
}
