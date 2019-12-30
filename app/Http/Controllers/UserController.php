<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //get first 5 recipies
        $recipes = User::orderBy('created_at', 'desc')->paginate(5);
        // return collection of recipies as a resource
        return UserResource::collection($recipes);
    }
}
