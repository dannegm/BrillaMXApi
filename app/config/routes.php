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

/*
* ----------------------------------
*  MICROSITIO
* ----------------------------------
*/

Route::get('/', [
	'uses' => 'IndexController@micrositio'
]);

/*
* ----------------------------------
*  USER ROUTES
* ----------------------------------
*/
Route::get('user/{id}', [
	'uses' => 'IndexController@user'
]);

Route::post('user/register', [
	'uses' => 'IndexController@register'
]);

Route::post('user/points/{id}', [
	'uses' => 'IndexController@addPoints'
]);

Route::get('user/selfie/{idSelfie}', [
	'uses' => 'IndexController@getSelfie'
]);

Route::get('user/selfies/{id}', [
	'uses' => 'IndexController@getSelfies'
]);

Route::post('user/selfie/{id}', [
	'uses' => 'IndexController@uploadSelfie'
]);

/*
* ----------------------------------
*  USERS ROUTES
* ----------------------------------
*/

Route::get('users', [
	'uses' => 'IndexController@users'
]);

Route::get('users/leaderboard/{fieldaction}', [
	'uses' => 'IndexController@leaderBoard'
]);

Route::get('users/selfie/', [
	'uses' => 'IndexController@getAllSelfies'
]);

Route::get('users/leaders/', [
	'uses' => 'IndexController@getLeaders'
]);
