<!-- this apply the header.bar layer from app.blad.php to this view -->
@extends('layouts.app')

@section('content')
<div class="container">

    @foreach ($posts as $post)

        <div class="row">
            <div class="col-6 offset-3">

                <a href="/profile/{{$post ->user->id }}">
                    <img src="/storage/{{ $post ->image}}" class="w-50" > <!-- full width viewport -->
                </a>
            </div>
        </div>

        <div class= "row pt-2 pb-5">

            <div class="col-6 offset-3">

                <div class= "d-flex align-items-center">
                     <div class="pe-3">
                            <!-- call profileImage() to show the default profile.img -->
                         <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
                     </div>
                     <div>
                            <div class="fw-bold pe-4"> 
                                <a href="/profile/{{ $post->user->id }}">
                                    <span class="text-dark">{{$post->user->username}}</span>
                                </a>
                            
                            </div>                        
                      </div>    
                    <div>
                        {{$post -> caption}}
                    </div>
                    <hr>
                </div>
            </div>

        </div>
    @endforeach

    <div class="row">
        <!--d-flex, just-content-center comes together  -->
        <div class="col-12 d-flex justify-content-center">
            <!-- show remaining/next button using bootstrap-5 style-->
            <!-- render the links to the rest of the pages in the result -->
            {{ $posts->links('pagination::bootstrap-5') }}   
        </div>

    </div>

</div>
@endsection
