@extends('layouts.app')
@section('content')
    <div class="well" data-postId="{{$post->id}}">
        <h3 class="text-center">{{$post->title}}</h3>
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <img src="/storage/images/{{$post->image}}" style="width:100%;">
            </div>
            <br>
            <div class="col-md-4 col-sm-4">
                <p>{{$post->caption}}</p>
                @if(Auth::user()->id === $post->user_id)
                {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST']) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!! Form::close() !!}
                @endif
            <h4>Post Likes: <span class="like-count">{{count($post->likes)}}</span></h4>
                <a href="#" class="like">{{$likeName}}</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
                {!!Form::open(['action' => ['CommentsController@store', $post->id], 'method' => 'POST'])!!}
                <div class="form-group">
                    {!!Form::label('comment', 'Write a comment')!!}
                    {!!Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Nice photo!!!', 'rows' => '4'])!!}
                </div>
                    {{Form::submit('Send', ['class' => 'btn btn-info btn-block'])}}
                {!! Form::close() !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-7 col-sm-7">
            @if (count($post->comments) > 0)
                @foreach ($post->comments as $comment)
                    <div class="well">
                    <p><a @if (Auth::user()->id === $comment->user_id)
                        href="/home"
                        @else
                        href="/visit/{{$comment->user_id}}"
                    @endif><strong>{{$comment->name}}</strong></a> - <small>{{$comment->email}}</small> <span class="pull-right">{{$comment->created_at}}</span></p>
                    <p>{{$comment->comment}}</p>
                    @if(Auth::user()->id === $comment->user_id)
                    {!! Form::open(['action' => ['CommentsController@destroy', $comment->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!! Form::close() !!}
                    @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <script>
       const  urlLike = '{{ route('like') }}';
       const token = '{{Session::token()}}';
    </script>
@endsection