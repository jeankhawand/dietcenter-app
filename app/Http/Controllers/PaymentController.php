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
//        dd();

//        dd($orders[0]->id);
        $str = $this->object_to_string($orders, $field = 'id');
//        dd($str);
        if ($request->user()) {
//            dd($request->user()->id);
            $description = 'Authenticated User';
            $userid = $request->user()->id;
        } else if (!$request->user()) {
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
                    ],
            ]);
//            dd($charge);
            // save this info to your database
            if ($request->user()) {
               $orderAuth =  Order::create([
                    'stripeId' => $charge->id,
                    'userId' => $request->user()->id,
                    'organizationId' => $request->user()->organization()->id,
                ]);
               $orderAuth->recipe->attach($this->formatit($orders));
            } else if (!$request->user()) {
                $orderNonAuth = Order::create([
                    'stripeId' => $charge->id,

                ]);
//                dd($orderNonAuth->id);
                $orderNonAuth->recipe()->attach($this->formatit($orders));
//                dd($orderNonAuth);
            }


            // SUCCESSFUL
            return response()->json('Thank you! Your payment has been accepted.');
        } catch (Exception $e) {
            // save info to database for failed
            return response()->json($e->getMessage() . $e->getCode());
        }
    }


}
