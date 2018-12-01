<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $fillable = ['name','description','icon','status'];

    public function entries(){
        return $this->hasMany('App\Entry') ;
    }
}
