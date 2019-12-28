<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    /** Setup many to many relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    protected $table ='Role';// custom user table
    public $timestamps = false;
//    protected $fillable = ['id','name'];
    public function users()
    {
        return $this->belongsToMany(User::class,'UserRole','roleId','userId');
    }
}
