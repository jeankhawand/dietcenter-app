<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //get first 5 recipies
        $recipes = Recipe::orderBy('created_at', 'desc')->paginate(5);
        // return collection of recipies as a resource
        return RecipeResource::collection($recipes);
    }
}
