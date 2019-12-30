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
    Route::get('user', function (Request $request) {
        return $request->user();
    });
    Route::get('role', function (Request $request) {
        return $request->user()->roles()->get();
    });
    // Store Recipe
    Route::post('recipe','RecipeController@store')->middleware('check-role:dietitian,chef');
    // Update Recipe
    Route::patch('recipe/{recipe}','RecipeController@update')->middleware('check-role:dietitian,chef');
    // Delete Recipe
    Route::delete('recipe/{recipe}','RecipeController@destroy')->middleware('check-role:dietitian,chef');
    // Logout
    Route::post('logout','AuthController@logout')->middleware('check-role:dietitian,chef,user,manager,admin');
    // Register users
    Route::post('register','AuthController@register')->middleware('check-role:dietitian,manager,admin');

});

// List Recipes
Route::get('recipes','RecipeController@index');
// List Single Recipe
Route::get('recipe/{id}','RecipeController@show');
// Auth for all users
Route::post('login','AuthController@login');
// Express Checkout for none-registered users
Route::post('checkout','PaymentController@checkout');

