<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
use App\Post;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comments = Comment::orderBy('created_at', 'desc')->get();
        return view('posts.show')->with('comments', $comments);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        //
        $this->validate($request, array(
            'comment' => 'required|max:2000'
        ));
        $post = Post::find($post_id);

        $comment = new Comment;
        $comment->name = auth()->user()->name;
        $comment->email = auth()->user()->email;
        $comment->comment = $request->input('comment');
        $comment->user_id = auth()->user()->id;
        $comment->post()->associate($post);

        $comment->save();
        return redirect('/posts/'.$post->id);

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

        $comment = Comment::find($id);
        if(auth()->user()->id !== $comment->user_id){
            return redirect('/home')->with('error', 'Unauthorized Action');
        }

        $comment->delete();
        return redirect('/posts/'.$comment->post_id)->with('success', 'Comment Removed');
    }
}
