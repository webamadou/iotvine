<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    public function prizes(){
        return $this->hasMany('App\Prize');
    }
}
