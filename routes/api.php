<?php

use App\Http\Resources\EmployeeResource;
use App\Http\Resources\RoleResource;
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
        // since I am receiving one instance not a collection
        return new EmployeeResource($request->user());
    });
    Route::get('role', function (Request $request) {
        return RoleResource::collection($request->user()->roles()->get());
    });
    //Auth User Checkout
    Route::post('checkout','PaymentController@checkoutAuth');
    // Logout
    Route::post('logout','AuthController@logout')->middleware('check-role:dietitian,chef,user,manager,admin');
    // Register users
    Route::post('register','AuthController@register')->middleware('check-role:dietitian,manager,admin');

    //-----Recipe-----
    // Store Recipe
    Route::post('recipe','RecipeController@store')->middleware('check-role:chef');
    // Update Recipe
    Route::patch('recipe/{recipe}','RecipeController@update')->middleware('check-role:chef');
    // Delete Recipe
    Route::delete('recipe/{recipe}','RecipeController@destroy')->middleware('check-role:chef');

    //-----Employee-----
    // Fetch Employee
    Route::get('employees','UserController@getEmployees')->middleware('check-role:manager');
    // Store employee
    Route::post('employee','UserController@storeEmployee')->middleware('check-role:manager');
    // Update employee
    Route::patch('employee/{user}','UserController@updateEmployee')->middleware('check-role:manager');
    // Delete employee
    Route::delete('employee/{user}','UserController@destroyEmployee')->middleware('check-role:manager');


    //-----Client-----
    // Fetch client
    Route::get('clients','UserController@getClients')->middleware('check-role:dietitian');
    // Store client
    Route::post('client','UserController@storeClient')->middleware('check-role:dietitian');
    // Update client
    Route::patch('client/{user}','UserController@updateClient')->middleware('check-role:dietitian');
    // Delete client
    Route::delete('client/{user}','UserController@deleteClient')->middleware('check-role:dietitian');
});

// List Recipes
Route::get('recipes','RecipeController@index');
// List Single Recipe
Route::get('recipe/{id}','RecipeController@show');
// Auth for all users
Route::post('login','AuthController@login');
// Express Checkout for none-registered users
Route::post('checkout','PaymentController@checkout');

