<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $followings = $user->followings;
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with(array('posts' => $posts, 'followings' => $followings));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate( $request, array(
            'title' => 'required',
            'caption' => 'required',
            'image' => 'image|required|max:1999'
        ));
        if($request->hasfile('image')){
            //Get image fullname.
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get image name.
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME );
            //Get image extension.
            $extension = $request->file('image')->getClientOriginalExtension();
            //Join filename and extension.
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Make a path.
            $path = $request->file('image')->storeAs('public/images/', $fileNameToStore);
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->caption = $request->input('caption');
        $post->image = $fileNameToStore;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/home')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        
        $like = auth()->user()->likes()->where('post_id', $post->id)->first() ? auth()->user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'Unlike' : 'Like' : 'Like';

        
        return view('posts.show')->with(array('post' => $post, 'likeName' => $like));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/home')->with('error', 'Unauthorized Action');
        }

        $post->delete();
        return redirect('/home')->with('success', 'Post Removed');
    }
}
