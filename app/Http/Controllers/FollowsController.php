<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Following;
use App\Follower;

class FollowsController extends Controller
{
    //
    public function followUser(Request $request){
        $user_id = $request['userId'];
        $isFollowing = $request['isFollowing'] === 'true';
        $user = User::find($user_id);
        if(!$user){
            return null;
        }
        $currentUser = auth()->user();
        $following = $currentUser->followings()->where('following_id', $user_id)->first();
        $follower = $user->followers()->where('follower_id', $currentUser->id)->first();
        if($following && $follower){
            $already_following = $following->following;
            $already_follower = $follower->follower;
            if($isFollowing == $already_following && $isFollowing == $already_follower){
                $following->delete();
                $follower->delete();
                return null;
            }
        }else{
            $following = new Following;
            $follower = new Follower;

        }

        
        $following->user_id = $currentUser->id;
        $following->following = $isFollowing;
        $following->following_id = $user_id;
        $following->save();

        
        $follower->user_id = $user_id;
        $follower->follower = $isFollowing;
        $follower->follower_id = $currentUser->id;
        $follower->save();



    }
}
