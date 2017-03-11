<?php

namespace App\Http\Controllers;

use App\Traits\ProfileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    use ProfileTrait;

    public function profile($uniqueIdentity){
        $this->data['user']=$this->getProfile($uniqueIdentity);
        if($this->data['user']->avatar==null){
            $this->data['avatar']=$this->data['user']->gender=='male'?'dsa':'';
        }
        return view('profile.profile',$this->data);
    }
}
