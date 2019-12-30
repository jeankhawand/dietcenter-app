<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //get first 5 users
        $users = User::orderBy('created_at', 'desc')->paginate(5);
        // return collection of users as a resource
        return UserResource::collection($users);
    }
    public function storeEmployee(Request $request)
    {
//        dd($request);
        $data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'phonenumber'=>'required',
            'password'=> 'required',
        ]);

      User::create(
             [
                 'name' => $request->name,
                 'email' => $request->email,
                 'phonenumber' => $request->phonenumber,
                 'password' => \Hash::make($request->password),
                 'created_by'=>$request->user()->id,
             ]
         )->roles()->attach($request->roles);

        return response()->json('Employee Created',200);
    }
}
