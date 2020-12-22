<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NewPostsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CreatePostController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\VoteController;
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


Route::get('/newposts', [NewPostsController::class, 'index'])->name('newposts');

Route::get('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/post/{id}', [PostController::class, 'singlePost']);
Route::post('/post/{id}', [CommentController::class, 'store']);

Route::post('/post/{post}/likes',  [VoteController::class, 'store'])->name('posts.likes');
Route::delete('/post/{post}/likes',  [VoteController::class, 'destroy']);

Route::post('saveComment/{id}', [CommentController::class, 'saveComment']);


Route::get('/user', [UserProfileController::class, 'index'])->name('userprofile');

Route::get('/createPost', [CreatePostController::class, 'index'])->name('createpost');
Route::post('/createPost', [CreatePostController::class, 'store']);

Route::delete('/post/deleteComment/{comment}',  [CommentController::class, 'destroy'])->name('deletecomment');
Route::post('/post/editComment/{id}',  [CommentController::class, 'edit'])->name('editcomment');




Route::get('/user/posts', [UserProfileController::class, 'usersposts'])->name('userspost');

Route::get('/home', function () {
    return view('home')->name('home');
});
