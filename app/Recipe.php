<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
    protected $table ='Recipe';// since migration are made as recipes we need to fix these to fit the table change
    public $timestamps = false;// by default this is enabled i had to disable it in order to seed data with faker
    protected $fillable = ['name','description','image'];
    public function user(){
        return this.$this->belongsTo('App\User');
    }
}
