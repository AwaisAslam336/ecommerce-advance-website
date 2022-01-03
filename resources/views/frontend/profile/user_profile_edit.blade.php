@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <br>
                <img class="card-img-top" style="border-radius: 50%" height="100%" width="100%" src="{{(!empty($user->photo)) ? url('upload/user_images/'.$user->photo) : url('upload/no_image.jpg') }}">
                <br><br>
                <ul class="list-group list-group-flush">
                    <a href="{{route('user_profile_dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{route('user_profile_edit')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{route('user_change_password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{route('logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </ul>
            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center">
                        <span class="text-danger">Hi...</span><strong>{{ Auth::user()->name }}</strong>
                        Update Your Profile
                    </h3>
                    <div class="card-body">
                            <form method="POST" action="{{route('user_profile_update')}}" enctype="multipart/form-data"">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{$message}} </strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address </label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" id="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{$message}} </strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" id="phone">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{$message}} </strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="photo">Profile Picture</label>
                                    <input type="file" name="photo" class="form-control" id="photo">
                                </div>
                                <button type="submit" class="btn-upper btn btn-danger">Update</button>
                                
                            </form>
                            <br>
                        </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection