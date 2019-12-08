<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Webpatser\Uuid\Uuid;
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    public $incrementing = false;
    protected $table ='User';
    public $timestamps = false;
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
        'name', 'email', 'password',
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
        return $this->hasMany('App\Recipe');
    }
    /**
     * this function return a relationship between user and role
     */
    public function roles()
    {
        return $this->belongsToMany('Role', 'UserRole');
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
    public function hasRole($check)
    {
        return in_array($check, array_fetch($this->roles->toArray(), 'name'));
    }
}
