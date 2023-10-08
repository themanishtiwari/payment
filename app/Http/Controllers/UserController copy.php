<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Session;
use Stripe\Error\Card;

class UserController extends Controller
{
    
    #=========================== Working Controller ========================#
    function form(){
        //\Session::flush();
        return view('form');
    }


    public function call(Request $request) {
        \Stripe\Stripe::setApiKey('sk_test_51NyURkSFaGHixBwz98ZVAr4Z5JK4pfLSZCZ8AaudE8NhAGlKrObrOc2GnFiayO1Ssn1Ktk30ZvwwfKxcRGQZWRlQ00EF1G4KHs');
        $customer = \Stripe\Customer::create(array(
          'name' => 'test',
          'description' => 'test description',
          'email' => 'email@gmail.com',
          'source' => $request->input('stripeToken'),
           "address" => ["city" => "San Francisco", "country" => "US", "line1" => "510 Townsend St", "postal_code" => "98140", "state" => "CA"]

      ));
        try {
            $pay=\Stripe\PaymentIntent::create ( array (
                    "amount" => 300,
                    "currency" => "inr",
                    "customer" =>  $customer["id"],
                    "description" => "first test payment."
            ) );
            echo"<pre>";
            print_r($pay);
            // Session::flash ( 'success-message', 'Payment done successfully !' );
            // return view ( 'form' );
        } catch ( Card $e ) {
            Session::flash ( 'fail-message', $e->get_message() );
            return view ( 'cardForm' );
        }
    }


    // public function stripeCheckout(Request $request)
    // {
    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    //     $redirectUrl = route('stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';

    //     $response = $stripe->checkout->sessions->create([
    //         'success_url' => $redirectUrl,

    //         'customer_email' => 'demo@gmail.com',

    //         'payment_method_types' => ['link','card'],

    //         'line_items' => [
    //             [
    //                 'price_data' => [
    //                     'product_data' => [
    //                         'name' => $request->product,
    //                     ],
    //                     'unit_amount' => 100 * $request->price,
    //                     'currency' => 'USD',
    //                 ],
    //                 'quantity' => 1
    //             ],
    //         ],

    //         'mode' => 'payment',
    //         'allow_promotion_codes' => true,
    //     ]);

    //     return redirect($response['url']);
    // }

    // public function stripeCheckoutSuccess(Request $request)
    // {
    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    //     $response = $stripe->checkout->sessions->retrieve($request->session_id);

    //     return redirect()->route('stripe.index')
    //                         ->with('success','Payment successful.');
    // }
}
