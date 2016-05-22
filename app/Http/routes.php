<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group([], function () {
    Route::get('index',"LoginController@index");
    Route::post('login','LoginController@tologin');
    Route::get('login','LoginController@login');
    Route::get('logout','LoginController@logout');

    Route::resource('notice','NoticeController');

    Route::resource('signup','SignUpController');
});
