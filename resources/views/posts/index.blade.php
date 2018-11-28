@extends('layouts.app')
@section('content')
@if (count($posts) > 0)
@foreach ($posts as $post)
    @foreach ($followings as $following)
        @if ($post->user_id == $following->following_id || $post->user_id == Auth::user()->id)
        <div class="well">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img src="/storage/images/{{$post->image}}" style="width: 100%;">
                </div>
                <div class="col-md-8 col-sm-8">
                    <h2><a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
                    <small>{{$post->created_at}}</small>
                </div>
            </div>
        </div>    
        @endif
    @endforeach
@endforeach
@else
    <div class="well">
        <p>No post found.</p>
    </div>    
@endif
@endsection