<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    protected $table ='UserRole';// custom user table
    public $timestamps = false; // disable defaults timestamp
}
