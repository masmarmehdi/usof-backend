<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\http\controllers\CategoryController;
use App\http\controllers\PostController;
use App\http\controllers\UserController;
use App\http\controllers\MailController;
use App\http\controllers\LikeDislikeController;
use App\http\controllers\CommentController;
use App\http\controllers\AdminController;

use App\http\controllers\PasswordResetController;
use App\http\controllers\ChangePasswordController;
use Middleware\AuthKey;



// Users and Auth routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('profile', [AuthController::class, 'userProfile']);
    Route::post('update', [UserController::class,'userUpdate']);
    Route::post('profilePicture', [UserController::class,'uploadProfilePicture']);
    Route::post('sendPasswordResetLink', [PasswordResetController::class,'sendEmail']);
    Route::post('resetPassword', [ChangePasswordController::class, 'passwordResetProcess']);    
});

Route::resource('users', UserController::class);


// Posts Routes
Route::prefix('posts')->middleware('auth')->group(function () {
    Route::get('{post_id}/categories', [CategoryController::class,'showCategories']);
    Route::get('{post_id}/comments', [CommentController::class,'showComments']);
    Route::post('{post_id}/comments', [CommentController::class,'createComment']);
    Route::get('{post_id}/like', [LikeDislikeController::class,'getLikes']);
    Route::get('{post_id}/dislike', [LikeDislikeController::class,'getDislikes']);
    Route::post('{post_id}/like', [LikeDislikeController::class,'createPostLike']);
    Route::delete('{post_id}/like', [LikeDislikeController::class,'deletePostLike']);
});
Route::resource('posts', PostController::class);


// Categories Routes
Route::prefix('categories')->middleware('auth')->group(function () {
    Route::get('{category_id}/posts', [CategoryController::class,'showPosts']);
});
Route::resource('categories', CategoryController::class);


// Comments Routes
Route::prefix('comments')->middleware('auth')->group(function () {
    Route::get('{comment_id}/like', [CommentController::class,'showCommentLikes']);
    Route::post('{comment_id}/like', [CommentController::class,'createCommentLike']);
    Route::delete('{comment_id}/like', [CommentController::class,'deleteCommentLike']);
});
Route::resource('comments', CommentController::class);


// Admin panel routes
Route::get('admin', [AdminController::class, 'home'])->name('home');
Route::get('admin/posts', [AdminController::class, 'showPosts'])->name('post.index');
Route::get('admin/posts/create', [AdminController::class, 'createPost'])->name('post.create');
Route::post('admin/posts', [AdminController::class, 'storePosts'])->name('post.store');

Route::get('admin/categories', [AdminController::class, 'showCategories'])->name('category.index');
Route::get('admin/categories/create', [AdminController::class, 'createCategory'])->name('category.create');
Route::post('admin/categories', [AdminController::class, 'storeCategory'])->name('category.store');

Route::get('admin/comments', [AdminController::class, 'showComments'])->name('comment.index');
Route::get('admin/comments/create', [AdminController::class, 'createComment'])->name('comment.create');
Route::post('admin/comments', [AdminController::class, 'storeComments'])->name('comment.store');

Route::get('admin/users/create', [AdminController::class, 'createUser'])->name('user.create');
Route::get('admin/users', [AdminController::class, 'showUsers'])->name('user.index');




