@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <br>
                <img class="card-img-top" style="border-radius: 50%" height="100%" width="100%" 
                src="{{(!empty($user->photo)) ? url('upload/user_images/'.$user->photo) : url('upload/no_image.jpg') }}">
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
                        Welcome To E-commerce Store
                    </h3>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection