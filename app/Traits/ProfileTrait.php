<?php
namespace App\Traits;


use App\User;
use Illuminate\Support\Facades\Auth;

trait ProfileTrait {

    public function getProfile($slug){
        $user = User::whereProfileId($slug)->orWhere('username',$slug)->first();
        if($user){
            return $user;
        }
        abort(404);
    }


}

