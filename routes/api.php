<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['auth:api'], 'namespace' => 'API'], function() {
    Route::group(['namespace' => 'Users', 'prefix' => '/users'], function() {
        Route::get('/', 'APIUserController@index')->name('api.users');
        Route::post('/', 'APIUserController@store')->name('api.users.store');
        Route::get('/{id}', 'APIUserController@show')->name('api.users.show');
        Route::put('/{id}', 'APIUserController@update')->name('api.users.update');
    });
});
