@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8">
            <h2 class="usersname" data-userid="{{$user->id}}">{{$user->name}}</h2> 

            <h5>Following: 
                <span class="following">{{count($user->followings)}}</span> Followers: <span class="follower">{{count($user->followers)}}</span>
            </h5>

            <a href="#" class="btn btn-primary" id="follow-btn">{{$followName}}</a>
        </div>
        
    </div>
    @if (!$already_followed)
        <div class="row">
            <div class="well">
                <p>Follow this person to see their posts.</p>
            </div>
        </div>
    @else
    <div class="row">
        @if (count($user->posts) > 0)
            <h4>Posts Total: ({{ count($user->posts) }})</h4>
            @foreach ($user->posts as $post)
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
                
            @endforeach
        @endif
    </div>
    @endif
</div>
<script>
    const token = '{{ csrf_token() }}';
    const urlFollow = '{{route('followUser')}}';
</script>
@endsection
