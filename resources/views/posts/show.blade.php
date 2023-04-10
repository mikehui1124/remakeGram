<!-- this apply the header.bar layer from app.blad.php to this view -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
             <img src="/storage/{{ $post ->image}}" class="w-100" > <!-- full width viewport -->
        </div>

        <div class="col-4">

          <div class= "d-flex align-items-center">
                <div class="pe-3">
                    <!-- call profileImage() to show the default profile.img -->
                    <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
                </div>
                <div>
                    <div class="fw-bold"> 
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="text-dark">{{$post->user->username}}</span>
                        </a> |
                        <a href="#" class="ps-2">Follow</a>
                    </div>
                </div>
          </div>
          <hr>

            <p>
                <span class="fw-bold pe-1">
                    <a href="/profile/{{ $post->user->id }}">
                        <span class="text-dark">{{$post->user->username}}</span>
                    </a>
                </span>{{$post -> caption}}                 
            </p>
        </div>

    </div>
</div>
@endsection
