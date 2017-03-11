<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    protected $fillable = [
        'sender', 'receiver', 'status',
    ];

    protected $table = 'friendship';

    public $timestamps = true;


}
