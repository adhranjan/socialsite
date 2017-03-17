<?php

namespace App\Http\Controllers;

use App\Notifications\NewWallPost;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create(Request $request){
        $post=Post::Create([
            'user_id'=>Auth::User()->id,
            'wall_of'=>Auth::User()->id,
            'content'=>$request->get('content'),
        ]);
        return $post->find($post->id);
    }

    public function wallPost(Request $request){
        $post=Post::Create([
            'user_id'=>Auth::User()->id,
            'wall_of'=>$request->get('wall_of'),
            'content'=>$request->get('content'),
        ]);
        return $post->find($post->id);
    }

    public function forwardToFriend(Request $request,Post $post)
    {
        $feed=$post->find($request->post);
        $poster=$feed->User;
        $posted=$feed->wallOf;
        $fn[0]=$posted;
        $fn[1]=$poster;
        $noticeListener=$feed->User->friends();
        foreach ($noticeListener as $friend){
            $fn[]=$friend;
        }
        $noticeListener1=$feed->wallOf->friends();
        foreach ($noticeListener1 as $friend){
            $fn1[]=$friend;
        }

        $finalListeners=array_diff(array_unique(array_merge($fn,$fn1)),[$poster]);
        foreach ($finalListeners as $listener){
            $listener->notify(new NewWallPost($feed));
        }
        return 1;
    }
}
