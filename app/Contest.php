<?php

namespace App;

use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Contest extends Model
{
    use FormAccessible;
    protected $guarded  = ['private'];
    protected $dates    = ['created_at','updated_at','end','start'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function entries(){
        return $this->belongsToMany('App\Entry')->withPivot('entry_link','description','point_per_entry','configs')->withTimestamps();
    }
    public function prizes(){
        return $this->belongsToMany('App\Prize')->withPivot('quantity','custom_description','custom_image','status')->withTimestamps();
    }

    public function getStartAttribute($value) {
        return Carbon::parse($value)->format('Y-m-d H:i');
    }
    public function getEndAttribute($value) {
        return Carbon::parse($value)->format('Y-m-d H:i');
    }

    public function formStartAttribute($value) {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }
    public function formEndAttribute($value) {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    /**
     * @param $value
     * This will set the slug by default  based on the name of the contest
     */
    public function setNameAttribute($value){
        $this->attributes['name'] = $value;
        if (@$this->attributes['slug'] == null){
            $this->attributes['slug'] = Str::slug($value);
        }
    }
    public function getImagesAttribute(){
        if($this->attributes['images'] == null){
            return url('/'). Storage::url('images/contests/default_contest.png');
        }
        //return url('/') . Storage::url('images/contests/default_contest.png');
        return url('/'). Storage::url($this->attributes['images']);
    }
}
