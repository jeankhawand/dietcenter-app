<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderRecipe extends Model
{
    protected $table ='OrderRecipe';// custom user table
    public $timestamps = false; // disable defaults timestamp
}
