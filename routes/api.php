<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('user')->uses('UserController@index');
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('post')->uses('PostController@index');
    Route::get('post')->uses('PostController@create');
    Route::get('post/{post}/edit')->uses('PostController@edit');
    Route::post('post')->uses('PostController@store');
    Route::get('post/{post}')->uses('PostController@show');
    Route::put('post/{post}')->uses('PostController@update');
    Route::delete('post/{post}')->uses('PostController@destroy');


    Route::get('user')->uses('UserController@create');
    Route::get('user/{user}/edit')->uses('UserController@edit');
    Route::post('user')->uses('UserController@store');
    Route::get('user/{user}')->uses('UserController@show');
    Route::put('user/{user}')->uses('UserController@update');
    Route::delete('user/{user}')->uses('UserController@destroy');
});

//Route::resource('user','UserController');
//Route::resource('post','PostController');






