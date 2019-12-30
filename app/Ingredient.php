<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use SoftDeletes;
    protected $table ='Ingredient';// custom user table
    public $timestamps = false; // disable defaults timestamp
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class,'RecipeIngredient','ingredientId','recipeId');
    }
}
