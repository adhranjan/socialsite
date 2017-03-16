<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $with=['User'];

    protected $fillable = [
        'user_id', 'post_id'
    ];

    public function Post(){
        return $this->belongsTo('App\Post','post_id');
    }

    public function User(){
        return $this->belongsTo('App\User','user_id');
    }

}
