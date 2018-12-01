<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{

    public function Network(){
        return $this->belongsTo('App\Network');
    }
}
