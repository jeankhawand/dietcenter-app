<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Organization extends Model
{
    public $incrementing = false;// disable defaults incrementing as integer key
    protected $table ='Organization';// custom user table
    public $timestamps = false; // disable defaults timestamp
    protected $fillable = [
        'id','name'
    ];
    protected $keyType = 'string'; // had to change key type since we are using uuid
    public static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->id = self::generateUuid();// generate uuid
        });
    }
    public static function generateUuid()
    {
        return Uuid::generate(4);
    }
    public function users(){
        return $this->hasMany(User::class,'organizationId');
    }

}
