<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\User;
use App\Post;

class LikesController extends Controller
{
    

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function likePost(Request $request)
    {
        $post_id = $request['postId'];
        $isLike = $request['liked'] === 'true';
        $update = false;

        $post = Post::find($post_id);
        if(!$post){
            return null;
        }
        $user = auth()->user();

        $like = $user->likes()->where('post_id', $post_id)->first();
        if($like){
            $liked = $like->like;
            $update = true;
            if($liked == $isLike){
                $like->delete();
                return null;
            }
        }else{
            $like = new Like;
            
        }
        $like->user_id = $user->id;
            $like->like = $isLike;
            $like->post()->associate($post);
            $like->save();
    }
    

    
}
