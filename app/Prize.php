<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{

    public function contests(){
        return $this->belongsToMany('App\Contest')->withPivot('quantity','custom_description','custom_image','status')->withTimestamps();
    }
    public function currency(){
        return $this->belongsTo('App\Currency');
    }

}
