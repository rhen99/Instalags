<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Following;
use App\Follower;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $data = array(
            'posts' => $user->posts,
            'name' => $user->name,
            'followers' => $user->followers,
            'followings' => $user->followings
        );

        return view('home')->with($data);
    }
    public function visit($id){

        $user = User::find($id);
        
        $following = auth()->user()->followings()->where('following_id', $user->id)->first() ? auth()->user()->followings()->where('following_id', $user->id)->first()->following == 1 ? 'Following' : 'Follow' : 'Follow';       

        $followed_already = auth()->user()->followings()->where('following_id', $user->id)->first();

        $data = array(
            'user' => $user,
            'followName' => $following,
            'already_followed' => $followed_already
        );
        if($user->id == auth()->user()->id){
            return redirect('/home');
        }

        return view('visit')->with($data);
    }

    public function search(Request $request){
        $searchKey = $request->search;
        $users = User::search($searchKey)->get();

        return view('search')->with('users', $users);
    }
    
}
