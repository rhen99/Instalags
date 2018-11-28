@extends('layouts.app')
@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::file('image')}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>

        <div class="form-group">
            {{Form::label('caption', 'Caption')}}
            {{Form::textarea('caption', '', [ 'class' => 'form-control', 'placeholder' => 'Write your caption here...'])}}
        </div>

        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    
   {!! Form::close() !!}

@endsection