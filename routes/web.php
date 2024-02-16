<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\likecommentcontroller;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\profilecontroller;
use App\Http\Controllers\uploadcontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('test', function () {
    return view('layout.layout');
});

// route at controller

// pergi ke halaman

// Login
Route::get('/', [Controller::class,'halamanlogin'])->name('login')->middleware('guest');
// register
Route::get('/register',[Controller::class,'halamanregister'])->middleware('guest');
// home
Route::get('/home',[Controller::class, 'halamanhome'])->middleware('auth');
// upload
Route::get('/upload', [Controller::class, 'halamanupload'])->middleware('auth');
// lihat foto
Route::get('/photo{id}', [Controller::class, 'halamanphoto'])->middleware('auth');
// lihat album
Route::get('/seealbums{id}', [Controller::class, 'halamanalbum'])->middleware('auth');
// like
Route::get('/likes',[Controller::class, 'halamanlike'])->middleware('auth');
// analytic
Route::get('/analytic', [Controller::class, 'halamananalytic'])->middleware('auth');
// following
Route::get('/following', [Controller::class, 'halamanfollowing'])->middleware('auth');

// search
Route::get('/search', [Controller::class, 'halamansearch'])->middleware('auth');


// profile
Route::get('/profile-{username}',[Controller::class, 'halamanprofile'])->middleware('auth');
Route::get('/editprofile', [Controller::class, 'editprofile'])->middleware('auth');
// profile-album
Route::get('/albums-{username}',[Controller::class, 'halamanprofilealbum'])->middleware('auth');
// profile-like
Route::get('/like-{username}',[Controller::class, 'halamanprofilelike'])->middleware('auth');





// action

// logincontroller 

// register
Route::post('/reg',[logincontroller::class, 'aksiregister']);
// login
Route::post('/log',[logincontroller::class, 'aksilogin']);
// logout
Route::post('/logout',[logincontroller::class, 'aksilogout']);



// uploadcontroller

// upload photo
Route::post('/uploadphoto', [uploadcontroller::class, 'uploadphoto']);
// upload ke keranjang
Route::post('/uploadkeranjang', [uploadcontroller::class, 'uploadkeranjang']);
Route::post('/hapuskeranjang', [uploadcontroller::class, 'hapuskeranjang']);
Route::post('/cancelkeranjang', [uploadcontroller::class, 'cancelkeranjang']);
// create album
Route::post('/createalbum', [uploadcontroller::class, 'createalbum']);

// update delete postingan and album

// update postingan
Route::post('/updatepost', [uploadcontroller::class, 'updatepost']);
// delete postingan
Route::post('/deletepost', [uploadcontroller::class, 'deletepost']);
// update album
Route::post('/updatealbum', [uploadcontroller::class, 'updatealbum']);
// delete album
Route::post('/deletealbum', [uploadcontroller::class, 'deletealbum']);



// profilecontroller

// profile
Route::post('/updateprofile', [profilecontroller::class, 'updateprofile']);
Route::post('/updatepassword', [profilecontroller::class, 'updatepassword']);



// likecomment controller

// like
Route::post('/like',[likecommentcontroller::class, 'aksilike']);
// unlike
Route::post('/unlike', [likecommentcontroller::class, 'aksiunlike']);
// comment
Route::post('/comment', [likecommentcontroller::class, 'aksicomment']);
// delete comment
Route::post('/deletecomment', [likecommentcontroller::class, 'aksideletecomment']);
// follow
Route::post('/follow',[likecommentcontroller::class, 'aksifollow']);
// unfollow
Route::post('/unfollow', [likecommentcontroller::class, 'aksiunfollow']);