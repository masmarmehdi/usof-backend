<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\controllers\UserController;
use App\http\controllers\AuthController;
use App\http\controllers\CategoryController;
use App\http\controllers\PostController;
use App\http\controllers\MailController;


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function($router){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('refresh', [AuthController::class, 'refresh']);

});

Route::middleware(['auth', 'second'])->group(function () {
    
});
// User Module:
Route::get('users', [UserController::class, 'showUsers']);
Route::post('users', [UserController::class, 'createUser']);
Route::get('users/{id}', [UserController::class,  'showUser']);
Route::patch('users/{id}', [UserController::class, 'updateUser']);
Route::delete('users/{id}', [UserController::class, 'deleteUser']);


// Post Module:
Route::get('posts',[PostController::class, 'showPosts']);
Route::post('posts', [PostController::class, 'createPost']);
Route::get('posts/{id}', [PostController::class,  'showPost']);
Route::patch('posts/{id}', [PostController::class, 'updatePost']);
Route::delete('posts/{id}', [PostController::class, 'deletePost']);
Route::get('posts/{id}/like', [PostController::class, 'getLikes']);
Route::post('posts/{id}/like', [PostController::class, 'createLike']);
Route::get('posts/{id}/dislike', [PostController::class, 'getDislikes']);
Route::get('post/{id}/comments', [PostController::class, 'getComments']);
Route::post('post/{id}/comments', [PostController::class, 'createComment']);




// Category Module:
Route::get('categories',[CategoryController::class, 'showCategories']);
Route::post('categories', [CategoryController::class, 'createCategory']);
Route::get('categories/{id}', [CategoryController::class,  'showCategory']);
Route::patch('categories/{id}', [CategoryController::class, 'updateCategory']);
Route::delete('categories/{id}', [CategoryController::class, 'deleteCategory']);



// Mail route

Route::post('sendEmail', [MailController::class, 'sendEmail']);