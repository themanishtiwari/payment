<?php

namespace App\Http\Controllers;

use Stripe;
use Session;
use Stripe\Error\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    
    function form(){
        //\Session::flush();
        return view('formm');
    }


    // public function call(Request $request) {
    //     \Stripe\Stripe::setApiKey('sk_test_51NyURkSFaGHixBwz98ZVAr4Z5JK4pfLSZCZ8AaudE8NhAGlKrObrOc2GnFiayO1Ssn1Ktk30ZvwwfKxcRGQZWRlQ00EF1G4KHs');
    //     $customer = \Stripe\Customer::create(array(
    //       'name' => 'test',
    //       'description' => 'test description',
    //       'email' => 'email@gmail.com',
    //       'source' => $request->input('stripeToken'),
    //        "address" => ["city" => "San Francisco", "country" => "US", "line1" => "510 Townsend St", "postal_code" => "98140", "state" => "CA"]

    //   ));
    //     try {
    //         $pay=\Stripe\PaymentIntent::create ( array (
    //                 "amount" => 300,
    //                 "currency" => "inr",
    //                 "customer" =>  $customer["id"],
    //                 "description" => "first test payment."
    //         ) );
    //         echo"<pre>";
    //         print_r($pay);
    //         // Session::flash ( 'success-message', 'Payment done successfully !' );
    //         // return view ( 'form' );
    //     } catch ( Card $e ) {
    //         Session::flash ( 'fail-message', $e->get_message() );
    //         return view ( 'form' );
    //     }
    // }




#for create token from backend

public function Stripe(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'card_no' => 'required',
        'ccExpiryMonth' => 'required',
        'ccExpiryYear' => 'required',
        'cvvNumber' => 'required',
        //'amount' => 'required',
        ]);
    $input = $request->all();
    if ($validator->fails()) { 
        echo"<pre>";
        print_r($validator->errors());
    }
    else{
        //$input = array_except($input,array('_token'));
        $stripe = \Stripe\Stripe::setApiKey('sk_test_51NyURkSFaGHixBwz98ZVAr4Z5JK4pfLSZCZ8AaudE8NhAGlKrObrOc2GnFiayO1Ssn1Ktk30ZvwwfKxcRGQZWRlQ00EF1G4KHs');
        // try {
        //     $token = $stripe->tokens()->create([
        //     'card' => [
        //     'number' => $request->get('card_no'),
        //     'exp_month' => $request->get('ccExpiryMonth'),
        //     'exp_year' => $request->get('ccExpiryYear'),
        //     'cvc' => $request->get('cvvNumber'),
        //     ],
        // ]);

        $token = \Stripe\PaymentIntent::create(array(
            "card" => array(
              "number"    => $request->input('card_no'),
              "exp_month" => $request->input('ccExpiryMonth'),
              "exp_year"  => $request->input('ccExpiryYear'),
              "cvc"       => $request->input('cvvNumber'),
              "name"      => $request->input('name')
          )));

        if (!isset($token['id'])) {
            return redirect()->route('addmoney.paymentstripe');
        }
        
        $charge = $stripe->charges()->create([
        'card' => $token['id'],
        'currency' => 'inr',
        'amount' => 20.49,
        'description' => 'wallet',
        ]);
        
        if($charge['status'] == 'succeeded') {
            echo "<pre>";
            print_r($charge);exit();
            return redirect()->route('addmoney.paymentstripe');
        } else {
            \Session::put('error','Money not add in wallet!!');
            return redirect()->route('addmoney.paymentstripe');
        }
        // } catch (Exception $e) {
        //     \Session::put('error',$e->getMessage());
        //     return redirect()->route('addmoney.paymentstripe');
        // } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
        //     \Session::put('error',$e->getMessage());
        //     return redirect()->route('addmoney.paywithstripe');
        // } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
        //     \Session::put('error',$e->getMessage());
        //     return redirect()->route('addmoney.paymentstripe');
        // }
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
