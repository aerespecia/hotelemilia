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
    
    public function IsFrontdesk(){
        if($this->role == "frontdesk")
            return true;
        else
            return false;
    }
    
    public function IsAdmin(){
        if($this->role == "admin")
            return true;
        else
            return false;
    }


    public function IsHousekeeping(){
        if($this->role == "3")
            return true;
        else
            return false;
    }
}
