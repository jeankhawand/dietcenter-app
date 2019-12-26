<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    protected $table ='RecipeIngredient';// custom user table
    public $timestamps = false; // disable defaults timestamp
}
