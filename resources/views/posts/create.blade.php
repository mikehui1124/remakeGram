<!-- this apply the header.bar layer from app.blad.php to this view -->
@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="post">
        <!-- add directive to authorize this end-point can only be hit by submitting the form -->
        @csrf
        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Add new post</h1>
                </div>

                <div class="row mb-3">
                    <!-- input must have a name.property that match the value.property -->
                    <label for="caption" class="col-md-4 col-form-label ">{{ __('Post Caption') }}</label>                    
                    <input id="caption" 
                        type="text" 
                        class="form-control @error('caption') is-invalid @enderror" 
                        name="caption" 
                        value="{{ old('caption') }}" 
                        required autocomplete="name" autofocus>

                        @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                </div>

                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Post Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">

                    @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror

                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Add New Post</button>

                </div>

            </div>

        </div>

    </form>
</div>
@endsection
