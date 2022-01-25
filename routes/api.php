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
Route::group(['prefix' => 'customer'], function(){
    Route::get('/', 'CustomerController@list');
    Route::get('/{id}', 'CustomerController@get');
    Route::post('/', 'CustomerController@store');
    Route::put('/{id}', 'CustomerController@update');
    Route::delete('/{id}', 'CustomerController@delete');
});
Route::group(['prefix' => 'user'], function(){
    Route::get('/', 'UserController@list');
    Route::get('/{id}', 'UserController@get');
    Route::post('/', 'UserController@store');
    Route::put('/{id}', 'UserController@update');
    Route::delete('/{id}', 'UserController@delete');
});
Route::group(['prefix' => 'hobbie'], function(){
    Route::get('/', 'HobbieController@list');
    Route::get('/{id}', 'HobbieController@get');
    Route::post('/', 'HobbieController@store');
    Route::put('/{id}', 'HobbieController@update');
    Route::delete('/{id}', 'HobbieController@delete');
});
Route::group(['prefix' => 'customerhobbie'], function(){
    Route::get('/', 'CustomerhobbieController@list');
    Route::get('/{id}', 'CustomerhobbieController@get');
    Route::post('/', 'CustomerhobbieController@store');
    Route::put('/{id}', 'CustomerhobbieController@update');
    Route::delete('/{id}', 'CustomerhobbieController@delete');
});
