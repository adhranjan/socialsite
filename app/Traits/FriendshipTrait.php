<?php
namespace App\Traits;

use App\Friendship;
use App\User;
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

    public function friends(){
        $friends1=array();

        $f1=Friendship::where('status',1)
                        ->where('sender',Auth::User()->id)
                        ->get();

        foreach ($f1 as $friendship){
            array_push($friends1,User::find($friendship->receiver));
        }

        $friends2=array();
        $f2=Friendship::where('status',1)
            ->where('receiver',Auth::User()->id)
            ->get();

        foreach ($f2 as $friendship){
            array_push($friends2,User::find($friendship->sender));
        }

        return array_merge($friends1,$friends2);
    }

}

