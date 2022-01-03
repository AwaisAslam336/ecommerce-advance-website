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
                    <h3 class="text-center">Change Password</h3>
                    <div class="card-body">
                            <form method="POST" action="{{route('user_update_password')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" name="old_password" class="form-control" id="current_password">
                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{$message}} </strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{$message}} </strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{$message}} </strong>
                                    </span>
                                    @enderror
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