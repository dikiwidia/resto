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

Route::get('/login','AuthController@index')->name('login.index');
Route::post('/login/attempt','AuthController@attempt')->name('login.attempt');
Route::get('/logout','AuthController@logout')->name('logout');

Route::group(['middleware' => 'loggedin'], function(){
    Route::get('/','DashboardController@index')->name('dashboard.index');
    Route::post('/getAjaxRequest','DashboardController@ajax')->name('dashboard.ajax');
    Route::post('/orderstore','DashboardController@store')->name('dashboard.store');
});
