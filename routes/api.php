<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->group(function(){
    //  these api's are exposed for user only
    // later on I will have to add user role so not everyone can get access to super users api
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/role', function (Request $request) {
        return $request->user()->roles()->get();
    });
    // Store Recipe
    Route::post('recipe','RecipeController@store')->middleware('check-role:dietitian,chef');
    // Update Recipe
    Route::patch('recipe/{recipe}','RecipeController@update')->middleware('check-role:dietitian,chef');
    // Delete Recipe
    Route::delete('recipe/{recipe}','RecipeController@destroy')->middleware('check-role:dietitian,chef');

    Route::post('/logout','AuthController@logout')->middleware('check-role:dietitian,chef,user,manager,admin');

});

// List Recipes
Route::get('recipes','RecipeController@index');
// List Single Recipe
Route::get('recipe/{id}','RecipeController@show');
// Auth for all users
Route::post('register','AuthController@register');
Route::post('login','AuthController@login');
Route::post('/checkout',function (Request $request){
    // dd($request->all());
    // validation
    try {
        $charge = Stripe::charges()->create([
            'amount' => $request->amount,
            'currency' => 'USD',
            'source' => $request->stripeToken,
            'description' => $request->description,
            'receipt_email' => $request->email,
            'metadata' => [
                'ip' => 'metadata 1',
                'session_id' => 'metadata 2',
                'product_id' => 'metadata 3',
            ],
        ]);
        // save this info to your database
        // SUCCESSFUL
        return back()->with('success_message', 'Thank you! Your payment has been accepted.');
    } catch (CardErrorException $e) {
        // save info to database for failed
        return back()->withErrors('Error! ' . $e->getMessage());
    }
});

