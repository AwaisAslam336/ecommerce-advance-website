<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\SellerController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Admin Route

Route::prefix('admin')->group(function(){
    Route::get('/login',[AdminController::class, 'LoginForm'])->name('login_form');
    Route::post('/login',[AdminController::class, 'Login'])->name('admin_login');
    Route::get('/logout',[AdminController::class, 'Logout'])->name('admin_logout');
    Route::get('/dashboard',[AdminController::class, 'Dashboard'])->name('admin_dashboard')->middleware('admin');
    Route::get('/register/form',[AdminController::class, 'RegisterForm'])->name('register_form');
    Route::post('/register',[AdminController::class, 'Register'])->name('admin_register');
    /////////////
    Route::get('/profile',[AdminProfileController::class, 'Profile'])->name('admin_profile');
    Route::get('/profile/edit',[AdminProfileController::class, 'ProfileEdit'])->name('admin_profile_edit');
    Route::post('/profile/update',[AdminProfileController::class, 'ProfileUpdate'])->name('admin_profile_update');
    Route::get('/change/password',[AdminProfileController::class, 'ChangePassword'])->name('admin_change_password');
    Route::post('/change/password',[AdminProfileController::class, 'UpdatePassword'])->name('update_change_password');

});


// Seller Route

Route::prefix('seller')->group(function(){
    Route::get('/login',[SellerController::class, 'LoginForm'])->name('seller_login_form');
    Route::post('/login',[SellerController::class, 'Login'])->name('seller_login');
    Route::get('/logout',[SellerController::class, 'Logout'])->name('seller_logout');
    Route::get('/dashboard',[SellerController::class, 'Dashboard'])->name('seller_dashboard')->middleware('seller');
    Route::get('/register/form',[SellerController::class, 'RegisterForm'])->name('seller_register_form');
    Route::post('/register',[SellerController::class, 'Register'])->name('seller_register');
});   

// FrontEnd Route
Route::get('/',[IndexController::class, 'Index']);

Route::get('/profile/edit',[IndexController::class,'UserProfileEdit'])->name('user_profile_edit');
Route::post('/profile/update',[IndexController::class,'UserProfileUpdate'])->name('user_profile_update');
Route::get('/password/change',[IndexController::class,'UserPasswordChange'])->name('user_change_password');
Route::post('/password/change',[IndexController::class,'UpdatePassword'])->name('user_update_password');
Route::get('/dashboard',[IndexController::class,'UserDashboard'])->middleware(['auth'])->name('user_profile_dashboard');

// Route::get('/dashboard', function () {
//     $id = Auth::user()->id;
//     $user = User::find($id);
//     return view('frontend.profile.dashboard',compact('user'));
// })->middleware(['auth'])->name('user_profile_dashboard');

require __DIR__.'/auth.php';
