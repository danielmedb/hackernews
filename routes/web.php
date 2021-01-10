<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NewPostsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResetPasswordController;
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


/* Login, logout, register, reset */

Route::get('/logout', [LogoutController::class, 'store'])->name('logout');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/resetpassword', [ResetPasswordController::class, 'index'])->name('resetpassword');
Route::get('/resetpassword/{token}', [ResetPasswordController::class, 'reset'])->name('resetpassword.token');
Route::post('/resetpassword/update/{token}', [ResetPasswordController::class, 'updatePassword'])->name('reset.store');



/* Logged in users only! */
Route::group(['middleware' => ['auth']], function () {

    /* Pages */
    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/top', [PostController::class, 'topVotedPosts'])->name('topVotes');
    Route::get('/comment', [PostController::class, 'mostComments'])->name('topComments');
    Route::get('/createPost', [CreatePostController::class, 'index'])->name('createpost');
    Route::get('/user', [UserProfileController::class, 'index'])->name('userprofile');

    /* Delete actions */
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::delete('/post/{post}/likes',  [VoteController::class, 'destroy']);
    Route::delete('/post/deleteComment/{comment}',  [CommentController::class, 'destroy'])->name('deletecomment');
    Route::post('/user/delete/{user}', [UserProfileController::class, 'deleteuser'])->name('userprofile.user.delete');

    /* Posts actions */
    Route::post('/post/{post}/likes',  [VoteController::class, 'store'])->name('posts.likes');

    Route::post('/createPost', [CreatePostController::class, 'store']);

    Route::get('/post/{id}', [PostController::class, 'singlePost']);
    Route::get('/post/edit/{post}', [PostController::class, 'editpost']);
    Route::post('/post/edit/{post}', [PostController::class, 'updatePost'])->name('posts.edit');

    Route::post('/post/{id}', [CommentController::class, 'store']);
    Route::post('/post/comment/update/{id}', [CommentController::class, 'commentUpdate']);
    Route::post('/post/editComment/{id}',  [CommentController::class, 'edit'])->name('editcomment');
    Route::get('/comment/{comment}/reply', [CommentController::class, 'reply'])->name('reply');
    Route::post('/comment/{comment}/reply', [CommentController::class, 'replyStore']);

    /* Userprofile */
    Route::get('/user/posts', [UserProfileController::class, 'usersposts'])->name('userspost');
    Route::post('/user/updateprofile/{user}', [UserProfileController::class, 'store'])->name('userprofile.store');
    Route::post('/user/updateprofile/imageupload/{user}', [UserProfileController::class, 'profileimageupdate'])->name('userprofile.image.upload');
    Route::post('/user/changepassword/{user}', [UserProfileController::class, 'changepassword'])->name('userprofile.password');
});

Route::get('/', function () {
    return view('/auth.login');
});
