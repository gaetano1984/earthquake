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

Route::group(['middleware' => 'auth'], function(){
	Route::get('/', 'QuakeController@list');
	Route::get('user_profile', 'UserController@profile')->name('user_profile');
	Route::post('update_profile', 'UserController@updateProfile')->name('update_profile');
	Route::group(['prefix' => 'quake'], function(){
		Route::get('list/{limit?}', 'QuakeController@list')->name('quake_list');
		Route::get('stats', 'QuakeController@stats')->name('quake_stats');
		Route::post('stats', 'QuakeController@statsFiltered')->name('quake_stats_post');
		Route::post('export', 'QuakeController@excelExport')->name('quake_excel_export');
	});
	Route::group(['middleware' => 'isAdmin'], function(){
		Route::get('manage_api', 'ApiController@index')->name('manage_api');
		Route::get('api_create', 'ApiController@create')->name('api_create');
		Route::post('api_store', 'ApiController@store')->name('api_store');
	});
});

Route::group(['prefix' => 'quake'], function(){
	Route::get('update', 'QuakeController@update');
});