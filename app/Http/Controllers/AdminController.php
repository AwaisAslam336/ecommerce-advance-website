<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function LoginForm(){
        return view('admin.login');
        
    }
    public function Dashboard(){
        return view('admin.index');
        
    }
    public function Login(Request $request){
        //dd($request->all());
        $check = $request->all();
        if(Auth::guard('admin')->attempt(['email'=> $check['email'], 'password'=> $check['password']]))
        {
            return redirect()->route('admin_dashboard');
        }else{
            return redirect()->route('login_form')->with('error','Invalid Email Or Password');
        }
    }

    public function Logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('error','Loged Out');
    }
    public function RegisterForm(){
        return view('admin.register');
    }
    public function Register(Request $request){
         
        Admin::insert([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('login_form')->with('error','New User Registered');
    }
}
