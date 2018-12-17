<?php

namespace App;

use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        //return Carbon::parse($value)->format('Y-m-d H:i');
        return new Carbon($value);
    }
    public function getEndAttribute($value) {
        //return Carbon::parse($value)->format('Y-m-d H:i');
        return new Carbon($value);
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

    /**
     * Here we setup the getter so that we will have either a saved picture from db or a default picture
     * @return string
     */
    public function getImagesAttribute(){
        $image  = $this->attributes['images'];
        $exists = Storage::disk('local')->exists($image);
        if( $this->attributes['images'] == null || !$exists){
            return url('/'). Storage::url('images/contests/default_contest.png');
        }
        return url('/'). Storage::url($image);
    }

    /**
     * The url attribute is set by combining th contest id and the user's id
     * @return mixed
     */
    /*public function setUrlAttribute(){
        if ( @$this->attributes['url'] === null){
            $this->attributes['url'] = $this->attributes['id'].''.Auth::user()->id;
        }
        return $this->attributes['url'];
    }*/
    /**
     * @return void
     */
    public static function boot(){
        parent::boot();
        self::created(function($model){
                $model->update(["url" => $model->id.''.$model->user_id]) ;
        });
    }
}
