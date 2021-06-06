<?php

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
Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']], function() {
    Route::group(['namespace' => 'Users', 'prefix' => '/users'], function() {
        Route::get('/', 'UserController@index')->name('users');
        Route::get('/store', 'UserController@store')->name('users.store');
        Route::get('/{id}', 'UserController@show')->name('users.show');
        Route::get('/{id}/update', 'UserController@update')->name('users.update');
    });
});

