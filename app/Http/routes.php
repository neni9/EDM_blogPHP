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

Route::pattern('id', '[1-9][0-9]*');

Route::group(['middleware' => ['web']], function () {

	Route::get('/', ['as' => 'home', 'uses' => 'FrontController@index']);
	Route::any('login', 'LoginController@login');

	Route::get('register', 'Auth\AuthController@getRegister');
	Route::post('register', 'Auth\AuthController@create');

	Route::any('logout', 'LoginController@logout');
	Route::post('rate', 'StatController@rate');

	Route::get('/article/{id}', 'FrontController@show');
	Route::get('category/{id}', 'FrontController@showPostByCat');
	Route::get('article/{id}', 'FrontController@showPost');

	Route::group(['middleware' => ['auth','admin']], function () {

	    Route::resource('post', 'PostController');

	});

});
