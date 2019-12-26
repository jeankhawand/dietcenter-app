<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use SoftDeletes;
    //
    protected $table ='Recipe';// since migration are made as recipes we need to fix these to fit the table change
    public $timestamps = false;// by default this is enabled i had to disable it in order to seed data with faker
    protected $fillable = ['name','description','image','price'];
    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
}
