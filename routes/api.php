<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\NewPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login')->uses('AuthController@login');
Route::get('register')->uses('AuthController@register');

//Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('post')->uses('PostController@index');
    Route::get('post/create')->uses('PostController@create');
    Route::get('post/{post}/edit')->uses('PostController@edit');
    Route::post('post')->uses('PostController@store');
    Route::get('post/{post}')->uses('PostController@show');
    Route::put('post/{post}')->uses('PostController@update');
    Route::delete('post/{post}')->uses('PostController@destroy');

    Route::get('user/{user}')->uses('UserController@show');
    Route::get('user')->uses('UserController@index');
    Route::put('user/{user}')->uses('UserController@update');
    Route::delete('user/{user}')->uses('UserController@destroy');
//});



Route::get('user/create')->uses('UserController@create');
Route::get('user/{user}/edit')->uses('UserController@edit');
Route::post('user')->uses('UserController@store');

Route::get('user/many_to_many_roles/{many_to_many_roles}')->uses('UserController@many_to_many_roles');
Route::get('user/many_to_many_users/{many_to_many_users}')->uses('UserController@many_to_many_users');










Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');

Route::post('forgot-password', [NewPasswordController::class, 'forgotPassword']);
Route::post('reset-password', [NewPasswordController::class, 'reset'])->name('password.reset');

Route::resource('comment','CommentController');

//Route::resource('user','UserController');
//Route::resource('post','PostController');






