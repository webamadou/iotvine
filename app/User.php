<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','password', 'email', 'token', 'fullname', 'image', 'service_api', 'address', 'city', 'url', 'rank'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','token'
    ];

    public function country(){
        return $this->belongsTo('App\Country') ;
    }

    public function contests(){
        return $this->hasMany('App\Contest');
    }

    /**
     * This will tell if the user is a admin or not based on the value of its rank
     * @return bool
     */
    public function isAdmin(){
        if($this->rank === 12){return true;}
        return false;
    }
}
