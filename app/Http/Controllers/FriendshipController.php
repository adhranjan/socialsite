<?php

namespace App\Http\Controllers;

use App\Notifications\AcceptedRequest;
use App\Notifications\NewFriendRequest;
use App\Traits\FriendshipTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    use FriendshipTrait;

    public function create($sendTo){

        if($sendTo== Auth::User()->id){//u cant be ur own friend
            return ['status'=>'fail'];
        }

        if($this->iSentToThisUser($sendTo)){// sending two times in a row !!
            return ['status'=>'fail'];
        }

        if($this->thisUserSentMe($sendTo)){//you sent to person, who already sent you request
            $this->updatePreviousRequest($this->thisUserSentMe($sendTo));
            return 'success';
        }

        if($this->areWeAlreadyFriends($sendTo)){
            return ['status'=>'fail'];
        }
        //Ready to send request now
        $this->createFriendRequest($sendTo);
        User::find($sendTo)->notify(new NewFriendRequest(Auth::User()));
        return 'success';
    }

    public function update($sentBy )
    {
        if($sentBy== Auth::User()->id){//u cant be ur own friend
            return ['status'=>'fail'];
        }

        if($this->iSentToThisUser($sentBy)){// sending two times in a row !!
            return ['status'=>'fail'];
        }

        if($this->thisUserSentMe($sentBy)){//accept bro !!
            $this->updatePreviousRequest($this->thisUserSentMe($sentBy));
            User::find($sentBy)->notify(new AcceptedRequest(Auth::User()));
            return ['status'=>'success'];
        }
        return ['status'=>'fail'];
    }


    public function cancel($id)
    {
        if($this->iSentToThisUser($id)){
            $this->cancelPreviousRequest($this->iSentToThisUser($id));
            return 1;
        }
        if($this->thisUserSentMe($id)){
            $this->cancelPreviousRequest($this->thisUserSentMe($id));
            return 1;
        }
        return 0;
    }

    public function fight($id){
        if($this->areWeAlreadyFriends($id)){
            $this->cancelPreviousRequest($this->areWeAlreadyFriends($id));
            return 1;
        }
        return 0;
    }


    public function statusCheck($id){

        if($this->iSentToThisUser($id)){
            return ['status'=>'cancel'];
        }

        if($this->thisUserSentMe($id)){
            return ['status'=>'accept/ignore'];
        }

        if($this->areWeAlreadyFriends($id)){
            return ['status'=>'fight'];
        }

        return ['status'=>'not_friend'];

    }
}
