<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /** convert orders id to string and save it to stripe orders for later reference
     * @param $objects
     * @param string $field
     * @param string $glue
     * @return string
     */
    public function object_to_string($objects, $field = 'name', $glue = ', ')
    {
        $output = array();
        if (!empty($objects) && count($objects) > 0) {
            foreach ($objects as $object) {
                if (is_array($object) && isset($object[$field])) {
                    $output[] = $object[$field];
                } else if (is_object($object) && isset($object->$field)) {
                    $output[] = $object->$field;
                } else {
                    break;
                }
            }
        }
        return join($glue, $output);
    }

    /** format to array of ids
     * @param $arr1
     * @return array
     */
    public function formatit($arr1)
    {
        $arr2 = [];
        $i = 0;
        foreach ($arr1 as $arr){
            $arr2[$i] = $arr->id;
            $i++;
        }
         return $arr2;

    }

    /** Checkout for None login User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function checkout(Request $request)
    {

        $orders = json_decode($request->meta);
        $str = $this->object_to_string($orders, $field = 'id');
        try {
//            dd($request->meta);
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            $charge = \Stripe\Charge::create([
                'amount' => $request->amount,
                'currency' => 'usd',
                'source' => $request->stripetoken,
                'description' => 'Express Checkout',
                'receipt_email' => $request->email,
                'metadata' =>
                    [
                        'user_id' => 'none',
                        'product_ids' => $str,
                        'email' => $request->email,
                        'phonenumber' => $request->phonenumber,
                    ],
            ]);

            // save this info to your database

                Order::create([
                    'stripeId' => $charge->id,

                ])->recipes()->attach($this->formatit($orders));
            return response()->json('Thank you! Your payment has been accepted.');
        }catch (\Exception $e){
            return response()->json('Unable to Process your Payment , Please Contact Us at hi@kwalka.com');
        }
    }

    /**Check in for Login Users
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function checkoutAuth(Request $request){
//        dd($request->user()->id);
//        dd($request->user()->organization()->id);

            $orders = json_decode($request->meta);
//        dd();
//        dd($orders[0]->id);
            $str = $this->object_to_string($orders, $field = 'id');
            try {

                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
                $charge = \Stripe\Charge::create([
                    'amount' => $request->amount,
                    'currency' => 'usd',
                    'source' => $request->stripetoken,
                    'description' => 'Authenticated User',
                    'receipt_email' => $request->user()->email,
                    'metadata' =>
                        [
                            'user_id' => $request->user()->id,
                            'product_ids' => $str,
                        ],
                ]);
                Order::create([
                    'stripeId' => $charge->id,
                    'userId' => $request->user()->id,
                ])->recipes()->attach($this->formatit($orders));
//                dd($request->user()->id);
                return response()->json('Thank you! Your payment has been accepted.');
        }catch (Exception $e){
                return response()->json('Unable to Process your Payment , Please Contact Us at hi@kwalka.com');
            }
    }


}
