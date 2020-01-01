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

    /** Checkout
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function checkout(Request $request)
    {

        $orders = json_decode($request->meta);
        $str = $this->object_to_string($orders, $field = 'id');
//
       if (!$request->user()) {
            $description = 'Express Checkout';
            $userid = 'none';
        }


//        $order = Order::firstOrCreate();
        try {
//            dd($request->meta);
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            $charge = \Stripe\Charge::create([
                'amount' => $request->amount,
                'currency' => 'usd',
                'source' => $request->stripetoken,
                'description' => $description,
                'receipt_email' => $request->email,
                'metadata' =>
                    [
                        'user_id' => $userid,
                        'product_ids' => $str,
                        'email' => $request->email,
                        'phonenumber' => $request->phonenumber,
                    ],
            ]);

            // save this info to your database
                $orderNonAuth = new Order;
                $orderNonAuth->create([
                    'stripeId' => $charge->id,
//                dd($orderNonAuth->id);
//                $orderNonAuth->save();
                ])->recipes()->attach($orderNonAuth->getKey(),$this->formatit($orders));
//                dd($orderNonAuth);
            return response()->json('Thank You!! For your Purchase');
        }catch (\Exception $e){
            return response()->json($e->getMessage() . $e->getCode());
        }
    }
    public function checkoutAuth(Request $request){

        if ($request->user()){
            $orders = json_decode($request->meta);
//        dd();
//            dd($request);
//        dd($orders[0]->id);
            $str = $this->object_to_string($orders, $field = 'id');
            $description = 'Authenticated User';
            try {
            dd($request->user()->email);
            dd($request->user()->organization()->id);
                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
                $charge = \Stripe\Charge::create([
                    'amount' => $request->amount,
                    'currency' => 'usd',
                    'source' => $request->stripetoken,
                    'description' => $description,
                    'receipt_email' => $request->user()->email,
                    'metadata' =>
                        [
                            'user_id' => $request->user()->id,
                            'product_ids' => $str,
                        ],
                ]);
                $orderAuth = new Order;
                $orderAuth->create([
                    'stripeId' => $charge->id,
                    'userId' => $request->user()->id,
                    'organizationId' => $request->user()->organization()->id,
                ]);
                $orderAuth->recipes()->attach($this->formatit($orders));
                return response()->json('Thank you! Your payment has been accepted.');
        }catch (Exception $e){
                return response()->json($e->getMessage() . $e->getCode());
            }
        }
        return response()->json('unable to proccess your payment');
    }


}
