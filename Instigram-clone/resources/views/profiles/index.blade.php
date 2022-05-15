@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-3 p-5">
                <img src="/storage/{{$user->profile->profileImage()}}" class="w-100 rounded-circle">
            </div>
            <div class="col-md-9">
                <div style="padding-top:5%; " class="d-flex justify-content-center">
                    <div>
                        <h1>{{$user->username}}</h1>
                        @can("notTheSameUser",$user->profile)
                            <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                        @endcan
                    </div>
                    
                    @can("update",$user->profile)
                        <a href="/p/create">Add new post</a>
                    @endcan    
                </div>
                @can("update",$user->profile)
                    <a href="/profile/{{$user->id}}/edit">edit profile</a>
                @endcan
                <div class="d-flex">
                    <div style="padding-right: 7%;"><strong>{{$userPosts}}</strong> posts</div>
                    <div style="padding-right: 7%;"><strong>{{$profileFollower}}</strong> followers</div>
                    <div style="padding-right: 7%;"><strong>{{$userFollowing}}</strong> following</div>

                </div>
                <div style="padding-top:3%"><h3>{{$user->profile->title}}</h3></div>
                <div>{{$user->profile->description}}</div>
                <div>                    
                    <a href="$user->profile->url" style="color:darkblue;">
                    {{$user->profile->url ?? "N/A"}}
                </a></div>
            </div>
        </div>
        <div class="row" style="padding-top:2%;">
            @foreach($user->posts as $post)
            <div class="col-4 pb-3">
                <a href="/p/{{$post->id}}">
                    <img src="/storage/{{$post->image}}" class="w-100">
                </a>
                
            </div>
            @endforeach
            
            
        </div>
    </div> 
</div>
@endsection
