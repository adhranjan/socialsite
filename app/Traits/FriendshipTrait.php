<?php
namespace App\Traits;

use App\Friendship;
use Illuminate\Support\Facades\Auth;

trait FriendshipTrait {

    public function userSentMeRequests(){
        return Friendship::where('receiver',Auth::User()->id)->get();
    }

    public function iSentRequestsToUsers(){
        return Friendship::where('sender',Auth::User()->id)->get();
    }

    public function iSentToThisUser($userId){
        $return= Friendship::where('sender',Auth::User()->id)->where('receiver',$userId)->where('status',0)->first();
        if($return){
            return $return;
        }
        return 0;
    }

    public function thisUserSentMe($userId){
        $return= Friendship::where('receiver',Auth::User()->id)->where('sender',$userId)->where('status',0)->first();
        if($return){
            return $return;
        }
        return 0;
    }

    public function areWeAlreadyFriends($userId){
        $yesFriendsTest= Friendship::where('receiver',Auth::User()->id)->where('sender',$userId)->where('status',1)->first();

        $yesFriendsTest1= Friendship::where('sender',Auth::User()->id)->where('receiver',$userId)->where('status',1)->first();

            if($yesFriendsTest){
                return $yesFriendsTest;
            }
            if($yesFriendsTest1){
                return $yesFriendsTest1;
            }
        return 0;
    }


    public function createFriendRequest($receiver){
        Friendship::create([
            'sender'=>Auth::User()->id,
            'receiver'=>$receiver,
        ]);
    }

    public function updatePreviousRequest($oldRequest){
        $oldRequest->fill([
            'status'=>1
        ])->save();
    }

    public function cancelPreviousRequest($oldRequest){
        $oldRequest->forceDelete();
    }

}

