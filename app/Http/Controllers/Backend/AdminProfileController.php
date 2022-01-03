<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function Profile(){
        $adminData = Admin::find(1);
        return view('admin.admin_profile',compact('adminData'));
    }
    public function ProfileEdit(){
        $adminData = Admin::find(1);
        return view('admin.admin_profile_edit',compact('adminData'));
    }
    public function ProfileUpdate(Request $request){
        $adminData = Admin::find(1);
        $adminData->name = $request->name;
        $adminData->email = $request->email;

        if($request->file('photo')){
            $file = $request->file('photo');
            unlink(public_path('upload/admin_images/'.$adminData->photo));
            $filename = date('ymdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $adminData['photo'] = $filename;
            
        }
        $adminData->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin_profile')->with($notification);
    }

    public function ChangePassword(){
        return view('admin.admin_change_password');
    }

    public function UpdatePassword(Request $request){

        $request->validate([
            'old_password'=> 'required',
            'password'=> 'required|confirmed',
        ]);

        $hashedPassword = Admin::find(1)->password;
        if(Hash::check($request->old_password,$hashedPassword)){
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            //Auth::logout();
            return redirect()->route('admin_logout');
        }
        else{
            return redirect()->back();
        }
    }
}
