<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\Api\{
    AuthController,
    CategoryController,
    PostController,
    UserController,
    LikeDislikeController,
    CommentController,
};

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'userProfile']);
    Route::post('update', [UserController::class,'userUpdate']);
    Route::post('profilePicture', [UserController::class,'updateProfilePicture']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
});

Route::resource('users', UserController::class);

// Post Routes

    Route::prefix('posts')->group(function () {
        Route::get('{post_id}/categories', [CategoryController::class,'showCategories']);
        Route::get('{post_id}/comments', [CommentController::class,'showComments']);

        Route::get('{post_id}/like', [LikeDislikeController::class,'getLikes']);
        Route::get('{post_id}/dislike', [LikeDislikeController::class,'getDislikes']);

        Route::middleware(['auth', 'verified'])->group(function (){
            Route::post('{post_id}/like', [LikeDislikeController::class,'postLike']);
            Route::post('{post_id}/dislike', [LikeDislikeController::class,'postDislike']);
            Route::post('{post_id}/comments', [CommentController::class,'createComment']);
        });
    });

Route::resource('posts', PostController::class);


// Categories Routes
Route::prefix('categories')->group(function () {
    Route::get('{category_id}/posts', [CategoryController::class,'showPosts']);
});
Route::resource('categories', CategoryController::class);

// Comments Routes
Route::prefix('comments')->group(function () {
    Route::get('{comment_id}/like', [CommentController::class,'showCommentLikes']);
    Route::middleware('auth')->group(function(){
        Route::post('{comment_id}/like', [LikeDislikeController::class,'commentLike']);
        Route::post('{comment_id}/dislike', [LikeDislikeController::class,'commentDislike']);
    });

});
Route::resource('comments', CommentController::class);








