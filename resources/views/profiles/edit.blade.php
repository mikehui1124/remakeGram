<!-- this apply the header layer from app.blad.php to this view -->
@extends('layouts.app')

@section('content')

<div class="container">

    <form action="/profile/{{ $user ->id}}" enctype="multipart/form-data" method="post">
        <!-- add directive to authorize this end-point can only be hit by submitting the form -->
        @csrf
        <!-- direct the form.method = 'PATCH' to match profile/update action  -->
        @method('PATCH')

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Edit Profile</h1>
                </div>

                <div class="row mb-3">
                    <!-- input must have a name.property that match the value.property -->
                    <label for="title" class="col-md-4 col-form-label ">{{ __('Title') }}</label>  
                    <!--default existing title when textbox is empty  -->
                    <input id="title" 
                        type="text" 
                        class="form-control @error('title') is-invalid @enderror" 
                        name="title"                        
                        value="{{ old('title') ?? $user->profile->title }}" 
                        required autocomplete="name" autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                </div>

                <div class="row mb-3">
                    <!-- input must have a name.property that match the value.property -->
                    <label for="description" class="col-md-4 col-form-label ">{{ __('Description') }}</label>                    
                    <input id="description" 
                        type="text" 
                        class="form-control @error('description') is-invalid @enderror" 
                        name="description" 
                        value="{{ old('description') ?? $user->profile->description}}" 
                        required autocomplete="name" autofocus>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                    
                </div>

                <div class="row mb-3">
                    <!-- input must have a name.property that match the value.property -->
                    <label for="url" class="col-md-4 col-form-label ">{{ __('URL') }}</label>                    
                    <input id="url" 
                        type="text" 
                        class="form-control @error('url') is-invalid @enderror" 
                        name="url" 
                        value="{{ old('url') ?? $user->profile->url }}" 
                        required autocomplete="name" autofocus>

                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                    
                </div>

                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Profile Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">

                    @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror

                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Save Profile</button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection
