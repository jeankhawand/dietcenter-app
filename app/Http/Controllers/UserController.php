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

        $data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:User,email',
            'phonenumber'=>'required|unique:User,phonenumber',
            'created_by'=>'required|string',

        ]);
        $role = $request->validate([
            'name' => 'required|string',
        ]);
        $employee = User::create($data)->roles()->attach($role);
        return response($employee,201);
    }
}
