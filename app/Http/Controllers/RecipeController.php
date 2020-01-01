<?php

namespace App\Http\Controllers;


use App\Http\Resources\RecipeResource;
use App\Recipe;
use Illuminate\Http\Request;


class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {

        $recipes = Recipe::orderBy('id')->paginate(8);
        return RecipeResource::collection($recipes);
    }

     public function showAll()
     {
         return view('app');
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get recipe by id
       $recipe = Recipe::findorFail($id);
        // return it
        return new RecipeResource($recipe);
    }
    public function store (Request $request){
        $data = $request->validate([
            'name'=>'required|string',
            'description'=>'required',
            'image'=>'required',
            'price'=>'required'
        ]);
        $recipe = Recipe::create($data);
        return response($recipe,201);
    }
    public function update (Request $request, Recipe $recipe){
        $data = $request->validate([
            'name'=>'required|string',
            'description'=>'required',
            'image'=>'required'
        ]);
        $recipe->update($data);
        return response($recipe,200);
    }
    public function updateAll (Request $request){
        $data = $request->validate([
            'name'=>'required|string',
            'description'=>'required',
            'image'=>'required'
        ]);
        Recipe::query()->update($data);
        return response('Updated all ',200);
    }
    public function destroy (Recipe $recipe){
        $recipe->delete();
        return response('Deleted',200);
    }

}
