@extends('layouts.app')

@section('content')
    @if (count($users) > 0)
    <h3>{{count($users)}} Results Found</h3>
        @foreach ($users as $user)
            <div class="well">
                <h3><a @if (Auth::user()->id == $user->id)
                    href="/home"
                @else
                href="/visit/{{$user->id}}"  
                @endif>{{$user->name}}</a></h3>
                <p>Posts: {{count($user->posts)}} Following: {{count($user->followings)}} Followers: {{count($user->followers)}}</p>
            </div>
        @endforeach
        
        @else
            <h3>No Resuts Found</h3>
    @endif
@endsection