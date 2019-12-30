<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    protected $table ='UserRole';// custom user table
    public $timestamps = false; // disable defaults timestamp
    public function EditedBy(){
        return $this->hasOne(User::class,'edited_by');
    }
    public function CreatedBy(){
        return $this->hasOne(User::class,'created_by');
    }
}
