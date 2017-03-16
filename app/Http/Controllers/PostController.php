<?php

namespace App\Http\Controllers;

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
}
