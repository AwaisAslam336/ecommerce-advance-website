<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function Index()
    {
        return view('frontend.index');
    }

    public function UserDashboard()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.dashboard', compact('user'));
    }

    public function UserProfileEdit()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile_edit', compact('user'));
    }

    public function UserProfileUpdate(Request $request)
    {
        $userData = User::find(Auth::user()->id);
        $userData->name = $request->name;
        $userData->email = $request->email;
        $userData->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            if ($userData->photo) {
                unlink(public_path('upload/user_images/' . $userData->photo));
            }
            $filename = date('ymdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $userData['photo'] = $filename;
        }
        $userData->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    }

    public function UserPasswordChange()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_change_password', compact('user'));
    }

    public function UpdatePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            //Auth::logout();
            return redirect()->route('logout');
        } else {
            return redirect()->back();
        }
    }
}
