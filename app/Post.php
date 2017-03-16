<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public $with=['user','likes','wallof'];
    protected $fillable = [
        'content', 'user_id','wall_of'
    ];

    public function User(){
        return $this->belongsTo('App\User','user_id');
    }

    public function wallOf(){
        return $this->belongsTo('App\User','wall_of');
    }

    public function getCreatedAtAttribute($created_at){
        return Carbon::parse($created_at)->diffForHumans();

    }

    public function Likes(){
        return $this->hasMany('App\Like','post_id');
    }


}
