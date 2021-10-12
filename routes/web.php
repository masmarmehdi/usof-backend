<?php

use App\Http\Controllers\Admin\{
    AdminController,
    CategoryController,
    CommentController,
    LikeDislikeController,
    PostController,
    UserController
};
use App\Http\Controllers\Admin\Auth\{
    LoginController,
    RegisterController,
    LogoutController,
    ForgotPasswordController,
    ResetPasswordController,
    VerifyEmailController
};

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('welcome');
})->name('homepage')->middleware('verified');

Route::group(['middleware'=> ['auth', 'isAdmin'], 'prefix' => 'admin'], function(){

    Route::get('/', [AdminController::class, 'home'])->name('home');

    Route::get('/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/profile/update', [AdminController::class, 'updateAdminProfile'])->name('admin.update');

    Route::prefix('post')->group(function (){
        Route::get('/', [PostController::class, 'index'])->name('post.index');
        Route::get('/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/', [PostController::class, 'store'])->name('post.store');
        Route::get('/{post_id}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::patch('/{post_id}/update', [PostController::class, 'update'])->name('post.update');
        Route::delete('/{post_id}/delete', [PostController::class, 'delete'])->name('post.delete');
        Route::patch('post-status/{id}', [PostController::class, 'postStatus'])->name('admin.post.status');
        Route::get('post-detail/{post_id}', [PostController::class, 'postDetail'])->name('post.detail');
        Route::post('{post_id}/like', [LikeDislikeController::class,'postLike'])->name('post.like');
        Route::post('{post_id}/dislike', [LikeDislikeController::class,'postDislike'])->name('post.dislike');
    });

    Route::resource('category', CategoryController::class, ['names' => [
        'index' => 'category.index',
        'create' => 'category.create',
        'store' => 'category.store',
        'show' => 'category.show',
        'edit' => 'category.edit',
        'update' => 'category.update',
        'destroy' => 'category.destroy',
    ]]);
    Route::get('category/{category_id}/detail', [CategoryController::class, 'detail'])->name('category.detail');
    Route::prefix('comment')->group(function () {
        Route::resource('comment', CommentController::class);
        Route::post('/{comment_id}/like', [LikeDislikeController::class, 'commentLike'])->name('comment.like');
        Route::post('/{comment_id}/dislike', [LikeDislikeController::class, 'commentDislike'])->name('comment.dislike');
    });

    Route::prefix('users')->group(function () {
        Route::resource('/', UserController::class, ['names' => [
            'index' => 'user.index',
            'create' => 'user.create',
            'store' => 'user.store',
            'show' => 'user.show',
            'edit' => 'user.edit',
            'update' => 'user.update',
            'destroy' => 'user.destroy',
        ]]);
        Route::get('/{user_id}/profile', [AdminController::class, 'userProfile'])->name('user.profile');
        Route::patch('/{user_id}/profile/update', [AdminController::class, 'updateUserProfile'])->name('user.profile.update');
    });
});

Route::group(['middleware'=> 'guest', 'prefix' => 'auth'], function(){

    Route::get('login', [LoginController::class, 'login'])->name('auth.login');
    Route::post('login', [LoginController::class, 'loginCheck'])->name('login.check');

    Route::get('register', [RegisterController::class, 'register'])->name('auth.register');
    Route::post('register', [RegisterController::class, 'registerCheck'])->name('register.check');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendPasswordResetLink'])->name('password.email');

    Route::get('/reset-password/{token}',[ResetPasswordController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'checkResetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function(){

    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

    Route::get('/email/verify', [VerifyEmailController::class, 'verifyEmail'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verificationVerify'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [VerifyEmailController::class, '__invoke'])->middleware('throttle:6,1')->name('verification.resend');

});

