<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $table ='UserOrder';// custom user table
    public $timestamps = false; // disable defaults timestamp
}
