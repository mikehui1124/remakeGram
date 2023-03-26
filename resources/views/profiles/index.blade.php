<!-- this apply the header layer from app.blad.php to this view -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile-> profileImage()}}" class="rounded-circle w-100" alt="">
            <!-- <img src="/storage/{{ $user->profile-> image}}" class="rounded-circle w-100" alt=""> -->
            <!-- <img src="https://popsql.com/static/external-logos/freecodecamp.png"  style= "max-height : 150px;"-->
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline pb-3">
                <div class="d-flex">
                    <!-- align username to center vertical -->
                    <div class="h3 align-item-center" >{{$user->username}}</div> 
                <!-- pass user.id back to <follow-button> as compon property-->
                    <follow-button user-id="{{$user ->id}}" follows="{{$follows}}"></follow-button>     
                </div>

                <!-- redirect to the create view -->
                @can('update', $user->profile)
                    <a href="/p/create">Add New Post</a>
                @endcan
                
            </div>

            <!-- if the policy condition is true, then display <a> tag -->
            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">  
                 <!--this variables are being passed and cached by Controller  -->
                <div class="pe-3" ><strong>{{ $postCount}}</strong> posts</div>
                <div class="pe-3"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="pe-3"><strong>{{ $followingCount }}</strong> following</div>
            </div>
            <div class="pt-5 font-weight-bold">{{$user->profile->title}}</div>
            <div >{{$user->profile->description}}</div>
            <div><a href="#">{{$user->profile->url ?? "N/A"}}</a></div>                   

        </div>

        <div class="row pt-5">
                
                @foreach($user->posts as $post)
                <div class="col-4 pb-4">
                    <!-- goto this URL route and show sth on screen, see web.php -->
                    <a href="/p/{{ $post->id }}">
                        <img src="/storage/{{ $post->image }}" class="w-100">
                    </a>
                </div>
                @endforeach

                <!-- <div class="col-4">
                    <img src="https://picsum.photos/600/500" class="w-100" alt="">
                        
                </div> -->

        </div>  


    </div>
</div>
@endsection
