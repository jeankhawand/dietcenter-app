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
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
        return $this->belongsToMany('App\Order');
    }
    /**
     * this function return a relationship between user and role
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,'UserRole','userId','roleId');
    }

    /**
     * check if the current user is an employee
     * @return bool
     */
    public function isEmployee()
    {
        $roles = $this->roles->toArray();
        return !empty($roles);
    }

    /** check user specific roles
     * @param $check
     * @return bool
     */
    public function hasRoleName()
    {
        return $this->roles()->select('name')->first();
    }
    public function hasRoleId()
    {
        return $this->roles()->select('roleId')->first();
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
