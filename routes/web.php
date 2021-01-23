<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NewPostsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;
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


/* Login,  register, reset */

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/resetpassword', [ResetPasswordController::class, 'index'])->name('resetpassword');
Route::get('/resetpassword/{token}', [ResetPasswordController::class, 'reset'])->name('resetpassword.token');
Route::post('/resetpassword/update/{token}', [ResetPasswordController::class, 'updatePassword'])->name('reset.store');



/* Logged in users only! */
Route::group(['middleware' => ['auth']], function () {

    Route::get('/logout', [LogoutController::class, 'store'])->name('logout');

    /* Pagecontroller */
    Route::get('/top', [PageController::class, 'mostVotes'])->name('topVotes');
    Route::get('/comment', [PageController::class, 'mostComments'])->name('topComments');
    Route::get('/following', [PageController::class, 'following'])->name('following');


    Route::resource('posts', PostController::class);
    Route::resource('posts.comments', CommentController::class);

    /* Pages */
    Route::get('/user', [UserProfileController::class, 'index'])->name('userprofile');


    /* Delete actions */
    Route::delete('/post/{post}/likes',  [VoteController::class, 'destroy']);

    /* Posts actions */
    Route::post('/post/{post}/likes',  [VoteController::class, 'store'])->name('posts.likes');
    Route::get('/comment/{comment}/reply', [CommentController::class, 'reply'])->name('reply');
    Route::post('/comment/{comment}/reply', [CommentController::class, 'replyStore'])->name('reply.store');

    Route::post("/comment/{comment}/like", [CommentLikeController::class, "store"])->name("commentLike.store");
    Route::delete("/comment/{comment}/like", [CommentLikeController::class, "destroy"])->name("commentLike.destroy");


    Route::post("/posts/{user}/follow", [UserProfileController::class, "follow"])->name("user.follow");
    Route::delete("/posts/{user}/follow", [UserProfileController::class, "unfollow"])->name("user.unfollow");


    /* Userprofile */
    Route::get('/user/posts', [UserProfileController::class, 'usersposts'])->name('userspost');
    Route::post('/user/updateprofile/{user}', [UserProfileController::class, 'store'])->name('userprofile.store');
    Route::post('/user/updateprofile/imageupload/{user}', [UserProfileController::class, 'profileimageupdate'])->name('userprofile.image.upload');
    Route::post('/user/changepassword/{user}', [UserProfileController::class, 'changepassword'])->name('userprofile.password');
});

Route::get('/', function () {
    return view('/auth.login');
});
