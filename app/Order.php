<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    public $incrementing = false;// disable defaults incrementing as integer key
    protected $table ='Order';// custom user table
    public $timestamps = false; // disable defaults timestamp
}
