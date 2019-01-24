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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'quake'], function(){
	Route::get('update', 'quakeController@update');
	Route::group(['middleware' => 'auth'], function(){
		Route::get('list', 'quakeController@list')->name('quake_list');	
		Route::get('stats', 'quakeController@stats')->name('quake_stats');
	});

});

Route::group(['middleware' => 'auth'], function(){
	Route::get('user_profile', 'UserController@profile')->name('user_profile');
	Route::post('update_profile', 'UserController@updateProfile')->name('update_profile');
});