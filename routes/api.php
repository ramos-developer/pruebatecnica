<?php

use App\Helpers\ProfileHelper;
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


Route::group(['middleware' => ['jwt.auth']], function () {

    Route::group(['middleware' => 'checkProfile: ' . ProfileHelper::ADMIN_PROFILE . ',' . ProfileHelper::CUSTOMER_PROFILE], function () {
        Route::group(['prefix' => 'customer'], function(){
            Route::get('/{id}', 'CustomerController@get')
            ->middleware('checkPrivilege:customer_details,their_profile');
            Route::put('/{id}', 'CustomerController@update')
            ->middleware('checkPrivilege:customer_update,their_profile');
        });
        Route::group(['prefix' => 'hobbie'], function(){
            Route::get('/filter', 'HobbieController@selectorList');
        });
    });
    Route::group(['middleware' => 'checkProfile: ' . ProfileHelper::ADMIN_PROFILE], function () {
        Route::group(['prefix' => 'customer'], function(){
            Route::get('/', 'CustomerController@list');
            Route::post('/', 'CustomerController@store');
            Route::delete('/{id}', 'CustomerController@delete');
        });
        Route::group(['prefix' => 'hobbie'], function(){
            Route::get('/', 'HobbieController@list');
            Route::get('/{id}', 'HobbieController@get');
            Route::post('/', 'HobbieController@store');
            Route::put('/{id}', 'HobbieController@update');
            Route::delete('/{id}', 'HobbieController@delete');
        });
    });

});

