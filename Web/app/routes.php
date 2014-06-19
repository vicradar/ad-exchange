<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('before' => 'auth'), function() 
{
	Route::get('/', function()
	{
		return View::make('hello');
	});

	Route::get('/adlist', 'AdController@index');
	Route::get('/adlist/edit/{id}', 'AdController@edit');
	Route::get('/adlist/create', 'AdController@create');

	Route::group(array('before' => 'csrf'), function()
	{
		Route::post('/adlist/edit/{id}', 'AdController@edit');
		Route::post('/adlist/create', 'AdController@create');
		Route::post('/adlist', 'AdController@deleteMultiple');
	});

	Route::get('/home', function() 
	{
		return Redirect::action('AdController@index');
	});

	Route::get('/todo', ['as' => 'todo', function()
	{
		return "TODO: This page";
	}]);

	Route::get('/logout', ['as' => 'logout', function()
	{
		Auth::logout();
		return Redirect::action('LoginController@showLogin');
	}]);
});

Route::get('/login', 'LoginController@showLogin');
Route::get('/logout', 'LoginController@logout');
Route::group(array('before' => 'csrf'), function()
{
	Route::post('/login', 'LoginController@tryLogin');
});

