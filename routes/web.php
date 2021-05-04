<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

// Route::get('/hello',[UserController::class, 'index']);

// Route::post('/upload', 'FormController@index');
Route::get('/register', [UserController::class, 'index']);

Route::post('/store', [UserController::class, 'store']);

Route::get('/login', [UserController::class, 'login']);

Route::post('/check', [UserController::class, 'check']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'show']);