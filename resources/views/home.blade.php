@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8">
        <h2>{{$name}}</h2>
        <h5>Following: {{count($followings)}} Followers: {{count($followers)}}</h5>
        </div>
    </div>
    <div class="row">
        @if (count($posts) > 0)
            <h4>Posts Total: ({{ count($posts) }})</h4>
            @foreach ($posts as $post)
            <div class="well">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img src="/storage/images/{{$post->image}}" style="width: 100%;">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h2><a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
                            <small>{{$post->created_at}}</small>
                            
                            {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                {{Form::hidden('_method', 'DELETE')}}

                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                
            @endforeach
        @endif
    </div>
</div>
@endsection
