<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function LoginForm(){
        return view('seller.login');
        
    }
    public function Dashboard(){
        return view('seller.index');
        
    }
    public function Login(Request $request){
        //dd($request->all());
        $check = $request->all();
        if(Auth::guard('seller')->attempt(['email'=> $check['email'], 'password'=> $check['password']]))
        {
            return redirect()->route('seller_dashboard');
        }else{
            return redirect()->route('seller_login_form')->with('error','Invalid Email Or Password');
        }
    }

    public function Logout(){
        Auth::guard('seller')->logout();
        return redirect()->route('seller_login_form')->with('error','Loged Out');
    }
    public function RegisterForm(){
        return view('seller.register');
    }
    public function Register(Request $request){
         
        Seller::insert([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('seller_login_form')->with('error','New User Registered');
    }
}

