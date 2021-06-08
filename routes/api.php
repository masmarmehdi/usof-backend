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
use App\http\controllers\PasswordResetController;
use App\http\controllers\ChangePasswordController;
use Middleware\AuthKey;


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

Route::apiResource('users', UserController::class);

Route::prefix('posts')->middleware('auth')->group(function () {
    Route::get('{post_id}/categories', [CategoryController::class,'showCategories']);
    Route::get('{post_id}/comments', [CommentController::class,'showComments']);
    Route::post('{post_id}/comments', [CommentController::class,'createComment']);
    Route::get('{post_id}/like', [LikeDislikeController::class,'getLikes']);
    Route::post('{post_id}/like', [LikeDislikeController::class,'createPostLike']);
    Route::delete('{post_id}/like', [LikeDislikeController::class,'deletePostLike']);
});
Route::apiResource('posts', PostController::class);


Route::prefix('categories')->middleware('auth')->group(function () {
    Route::get('{category_id}/posts', [PostsController::class,'showPosts']);
});
Route::apiResource('categories', CategoryController::class);

Route::prefix('comments')->middleware('auth')->group(function () {
    Route::get('{comment_id}/like', [PostController::class,'showCommentLikes']);
    Route::post('{comment_id}/like', [PostController::class,'createCommentLike']);
    Route::delete('{comment_id}/like', [PostController::class,'deleteCommentLike']);
});
Route::apiResource('comments', CommentsController::class);

Route::apiResource('like', LikeController::class);

Route::post('sendEmail', [MailController::class, 'sendEmail']);
