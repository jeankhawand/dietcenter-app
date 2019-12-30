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
        'id','name', 'email', 'password', 'phonenumber' ,'created_by'
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

    /**
     * Find out if User is an employee, based on if has any roles
     *
     * @return boolean
     */
    public function isEmployee()
    {
        $roles = $this->roles->toArray();
        return !empty($roles);
    }

    /**
     * Find out if user has a specific role
     *
     * $return boolean
     */
    public function hasRole($check)
    {
        return in_array($check, array_fetch($this->roles->toArray(), 'name'));
    }
    /**
     * Get key in array with corresponding value
     *
     * @return int
     */
    private function getIdInArray($array, $term)
    {
        foreach ($array as $key => $value) {
            if ($value == $term) {
                return $key;
            }
        }

        throw new UnexpectedValueException;
    }
    /**
     * Add roles to user to make them a concierge
     */
    public function makeEmployee($title)
    {
        $assigned_roles = array();

        $roles = array_fetch(Role::all()->toArray(), 'name');



        $this->roles()->attach($assigned_roles);
    }
}
