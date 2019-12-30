<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    protected $table ='RecipeIngredient';// custom user table
    public $timestamps = false; // disable defaults timestamp
    public function EditedBy(){
        return $this->hasOne(User::class,'edited_by');
    }
    public function CreatedBy(){
        return $this->hasOne(User::class,'created_by');
    }
}
