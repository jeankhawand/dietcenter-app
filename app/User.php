<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable,SoftDeletes;
    public $incrementing = false;// disable defaults incrementing as integer key
    protected $table ='User';// custom user table
    public $timestamps = false; // disable defaults timestamp
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
    public function EditedBy(){
        return $this->hasOne(User::class,'edited_by');
    }
    public function CreatedBy(){
        return $this->hasOne(User::class,'created_by');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password', 'phonenumber' ,'created_by','edited_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * this function return a relationship between user and order
     */
    public function orders(){
        return $this->hasMany(Order::class,'userId');
        //
    }
    /**
     * this function return a relationship between user and role
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,'UserRole','userId','roleId');
    }
    public function organization(){
        return $this->belongsTo(Organization::class,'organizationId');
    }


    public function isUser()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'user')
            {
                return true;
            }
        }

        return false;
    }
    public function isUserSecond()
    {
        return null !== $this->roles()->where('name', 'user')->first();
    }
    public function isEmployee($roleName)
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == $roleName)
            {
                return true;
            }
        }

        return false;
    }
}
