<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * recieve request from non-registered users and make checkout order
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function checkout (Request $request){
        try {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            $charge = \Stripe\Charge::create([
                'amount' => 3000,
                'currency' => 'usd',
                'source' => $request->stripetoken,
                'description' => 'some description',
                'receipt_email' => $request->email,
                'metadata' => [
                    'ip' => 'metadata 1',
                    'session_id' => 'metadata 2',
                    'product_id' => 'metadata 3',
                ],
            ]);
//        dd($charge);
            // save this info to your database
            // SUCCESSFUL
            return response()->json('Thank you! Your payment has been accepted.');
        } catch (Exception $e) {
            // save info to database for failed
            return response()->json($e->getMessage() . $e->getCode());
        }
    }
}
