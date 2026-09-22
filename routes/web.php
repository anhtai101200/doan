<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// PHAN ADMIN

Route::get('/admin/dashboard', [DashboardController::class, 'index']);


Route::get('/admin/profile/update', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user.profile');

Route::post('/admin/profile/update', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.user.update');

Route::get('/admin/logout', [App\Http\Controllers\Admin\UserController::class, 'logout'])->name('admin.logout');


//BLOG  
Route::get('/blog/add', [App\Http\Controllers\Admin\BlogController::class, 'add']);
Route::post('/blog/add', [App\Http\Controllers\Admin\BlogController::class, 'insert']);
Route::get('/blog/list', [App\Http\Controllers\Admin\BlogController::class, 'list']);
Route::get('/blog/edit/{id}', [App\Http\Controllers\Admin\BlogController::class, 'edit']);
Route::post('/blog/edit/{id}', [App\Http\Controllers\Admin\BlogController::class, 'update']);
Route::get('/blog/delete/{id}', [App\Http\Controllers\Admin\BlogController::class, 'delete']);

//COUNTRY
// Route::get('/country/list', [App\Http\Controllers\Admin\CountryController::class, 'index']);
Route::get('/country/add', [App\Http\Controllers\Admin\CountryController::class, 'add']);
Route::post('/country/add', [App\Http\Controllers\Admin\CountryController::class, 'insert']);
Route::get('/country/list', [App\Http\Controllers\Admin\CountryController::class, 'list']);
Route::get('/country/delete/{id}', [App\Http\Controllers\Admin\CountryController::class, 'delete']);

//CATEGORY
// Route::get('/category/list', [App\Http\Controllers\Admin\Product\CategoryController::class, 'index']);
Route::get('/category/add', [App\Http\Controllers\Admin\Product\CategoryController::class, 'add']);
Route::post('/category/add', [App\Http\Controllers\Admin\Product\CategoryController::class, 'insert']);
Route::get('/category/list', [App\Http\Controllers\Admin\Product\CategoryController::class, 'list']);
Route::get('/category/edit/{id}', [App\Http\Controllers\Admin\Product\CategoryController::class, 'edit']);
Route::post('/category/edit/{id}', [App\Http\Controllers\Admin\Product\CategoryController::class, 'update']);
Route::get('/category/delete/{id}', [App\Http\Controllers\Admin\Product\CategoryController::class, 'delete']);


//BRAND
// Route::get('/category/list', [App\Http\Controllers\Admin\Product\CategoryController::class, 'index']);
Route::get('/brand/add', [App\Http\Controllers\Admin\Product\BrandController::class, 'add']);
Route::post('/brand/add', [App\Http\Controllers\Admin\Product\BrandController::class, 'insert']);
Route::get('/brand/list', [App\Http\Controllers\Admin\Product\BrandController::class, 'list']);
Route::get('/brand/edit/{id}', [App\Http\Controllers\Admin\Product\BrandController::class, 'edit']);
Route::post('/brand/edit/{id}', [App\Http\Controllers\Admin\Product\BrandController::class, 'update']);
Route::get('/brand/delete/{id}', [App\Http\Controllers\Admin\Product\BrandController::class, 'delete']);


//PHAN FRONTEND
Route::get('/',[HomeController::class,'index'])->name('frontend.home');
Route::get('/frontend/register',[MemberController::class,'register']);
Route::post('/frontend/register',[MemberController::class,'insert'])->name('frontend.member.register');
Route::get('/frontend/login', [MemberController::class, 'index'])->name('frontend.login');
Route::post('/frontend/login',[MemberController::class,'login'])->name('frontend.member.login');
// Route::get('/frontend/logout', [MemberController::class, 'logout'])->name('frontend.logout');

//PHAN BLOG FRONTEND
Route::get('/frontend/bloglist', [App\Http\Controllers\Frontend\BlogController::class, 'list']);
Route::get('/frontend/blogdetail/{id}', [App\Http\Controllers\Frontend\BlogController::class, 'detail']);
Route::post('/blog/rate/ajax', [App\Http\Controllers\Frontend\BlogController::class, 'rate']);
// Route::post('/blog/comment', [App\Http\Controllers\Frontend\BlogController::class, 'comment']);
Route::post('/blog/comment/ajax', [App\Http\Controllers\Frontend\BlogController::class, 'comment']);

//UPDATE ACCOUNT
Route::get('/frontend/logout', [MemberController::class, 'logout']);
Route::get('/frontend/account', [MemberController::class, 'account'])->name('frontend.account');
Route::post('/account/update', [MemberController::class, 'update']);

//PRODUCTS
Route::get('/product/add', [ProductController::class, 'add'])->name('frontend.add');
Route::post('/product/add', [ProductController::class, 'insert'])->name('frontend.insert');
Route::get('/product', [ProductController::class, 'list'])->name('frontend.list');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('frontend.edit');
Route::post('/product/edit/{id}', [ProductController::class, 'update'])->name('frontend.update');



Auth::routes();



