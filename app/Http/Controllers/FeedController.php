<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index(){
        $posts=Post::whereHas('User',function($user){
            $friends=Auth::User()->friends();
            $fn=array(Auth::User()->id);
            foreach ($friends as $friend){
                $fn[]=$friend->id;
            }
            $user->whereIn('id',$fn);
        });
        $feed=$posts->orderBy('id','desc')->paginate(4)->toArray()['data'];
        return $feed;
    }

    public function feedOnWall($id){
        $post=Post::where('wall_of',$id)->orderBy('id','desc')->paginate(4)->toArray()['data'];
        return $post;
    }
}
