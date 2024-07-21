<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use App\Http\Resources\StripeResource;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StripePaymentController extends Controller
{
    public function makePayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            // Create a PaymentIntent to charge a customer
            $user = User::where('email', $request->email)->first();
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100, // Example amount in cents
                'currency' => 'usd',
                'payment_method_types' => ['card']
            ]);

            // Return client secret to frontend
            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
                'scheduled' => true,
            ]);
        } catch (ApiErrorException $e) {
            // Handle error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function setNextChargeDate(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user) {
            $user->next_charge_date = $request->next_charge_date;
            $user->save();

            return response()->json(['message' => 'Next charge date set successfully'], 200);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

//     public function handlePaymentSuccess(Request $request)
// {
//     Stripe::setApiKey(env('STRIPE_SECRET'));
//     try {
//         $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);

//         if ($paymentIntent->status === 'succeeded') {
//             $user = User::where('email', $request->email)->first();
//             $plan = $request->input('plan');

//             if ($user) {
//                 // // Calculate next charge date (1 month from current date)
//                 // $nextChargeDate = Carbon::now()->addMonth();

//                 // // Update user's next_charge_date, post_count, and has_paid flag
//                 // $user->next_charge_date = $nextChargeDate;
//                 $user->post_count = 0;
//                 $user->has_paid = true;
//                 $user->save();

//                 return response()->json([
//                     'status' => true,
//                     'message' => 'Payment successful. Post count reset for user.',
//                 ]);
//             }
//             if($user){
//                 if ($plan === 'Pro') {
//                     $user->title = 'Pro';
//                     $user->next_payment_date = now()->addMonth();  // Set the next payment date to 1 month later
//                 } else {
//                     // Handle other plans if necessary
//                 }
        
//                 $user->save();
//             }
//         } else {
//             return response()->json([
//                 'status' => false,
//                 'message' => 'Payment not successful.',
//                 'payment_intent_status' => $paymentIntent->status,
//             ], 400);
//         }
        
//     } catch (ApiErrorException $e) {
//         // Handle error
//         return response()->json([
//             'status' => false,
//             'message' => 'An error occurred while confirming the payment.',
//             'error' => $e->getMessage()
//         ], 500);
//     }
// }
public function handlePaymentSuccess(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));
    try {
        $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);

        if ($paymentIntent->status === 'succeeded') {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                // Calculate next charge date based on the plan
                $nextChargeDate = Carbon::now();
                if ($request->plan === 'Pro') {
                    $nextChargeDate = $nextChargeDate->addMonth(); // Set next charge date for Pro plan
                }

                // Update user's next_charge_date, post_count, and has_paid flag
                $user->next_charge_date = $nextChargeDate;
                $user->post_count = 0;
                $user->has_paid = true;
                $user->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Payment successful. Post count reset for user.',
                    'next_charge_date' => $nextChargeDate->toDateString(),
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
