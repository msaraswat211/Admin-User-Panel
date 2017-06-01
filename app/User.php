<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active', 'photo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * relation with role model
     */
    public function role(){
        return $this->belongsTo('App\Role');
    }

    /*
     * relation with photo model
     */
    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    /*
     * method for check user is admin or not
     */
    public function isAdmin(){
        if($this->role->name == 'administrator' && $this->is_active==1){
            return true;
        }
        return false;
    }

    /*
     * get attribute with ucwords name
     */
    public function getNameAttribute($value){
        return ucwords($value);
    }
}
