<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
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

//Admin Brand all Route
Route::prefix('brand')->group(function(){
    Route::get('/all',[BrandController::class,'AllBrands'])->name('all_brands');
    Route::post('/store',[BrandController::class,'StoreBrand'])->name('store_brand');
    Route::get('/edit/{id}',[BrandController::class,'EditBrand'])->name('edit_brand');
    Route::post('/update',[BrandController::class,'UpdateBrand'])->name('update_brand');
    Route::get('/delete/{id}',[BrandController::class,'DeleteBrand'])->name('delete_brand');
});

//Admin Category all Route
Route::prefix('category')->group(function(){
    Route::get('/all',[CategoryController::class,'AllCategories'])->name('all_categories');
    Route::post('/store',[CategoryController::class,'StoreCategory'])->name('store_category');
    Route::get('/edit/{id}',[CategoryController::class,'EditCategory'])->name('edit_category');
    Route::post('/update',[CategoryController::class,'UpdateCategory'])->name('update_category');
    Route::get('/delete/{id}',[CategoryController::class,'DeleteCategory'])->name('delete_category');
});

//Admin SubCategory all Route
Route::prefix('subcategory')->group(function(){
    Route::get('/all',[SubCategoryController::class,'AllSubCategories'])->name('all_subcategories');
    Route::post('/store',[SubCategoryController::class,'StoreSubCategory'])->name('store_subcategory');
    Route::get('/edit/{id}',[SubCategoryController::class,'EditSubCategory'])->name('edit_subcategory');
    Route::post('/update',[SubCategoryController::class,'UpdateSubCategory'])->name('update_subcategory');
    Route::get('/delete/{id}',[SubCategoryController::class,'DeleteSubCategory'])->name('delete_subcategory');
});

//Admin Sub->SubCategory all Route
Route::prefix('subsubcategory')->group(function(){
    Route::get('/all',[SubSubCategoryController::class,'AllSubSubCategories'])->name('all_subsubcategories');
    Route::post('/store',[SubSubCategoryController::class,'StoreSubSubCategory'])->name('store_subsubcategory');
    Route::get('/edit/{id}',[SubSubCategoryController::class,'EditSubSubCategory'])->name('edit_subsubcategory');
    Route::post('/update',[SubSubCategoryController::class,'UpdateSubSubCategory'])->name('update_subsubcategory');
    Route::get('/delete/{id}',[SubSubCategoryController::class,'DeleteSubSubCategory'])->name('delete_subsubcategory');
    Route::get('/subcategory/ajax/{category_id}',[SubSubCategoryController::class,'GetSubCategory']);
    Route::get('/sub-subcategory/ajax/{subcategory_id}',[SubSubCategoryController::class,'GetSubSubCategory']);
});

//Admin Products all Route
Route::prefix('product')->group(function(){
    Route::get('/add',[ProductController::class,'AddProduct'])->name('add_product');
    Route::post('/store',[ProductController::class,'StoreProduct'])->name('store_product');
    Route::get('/manage',[ProductController::class,'ManageProduct'])->name('manage_product');
    Route::get('/edit/{id}',[ProductController::class,'EditProduct'])->name('edit_product');
    Route::post('/data/update',[ProductController::class,'UpdateProductData'])->name('update_product');
    
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


require __DIR__.'/auth.php';
        