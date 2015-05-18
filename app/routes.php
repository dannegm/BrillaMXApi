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
	'as' => 'index', 'uses' => 'IndexController@micrositio'
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

Route::post('user/twitter/{id}', [
	'uses' => 'IndexController@addTwitter'
]);

Route::post('user/points/{id}', [
	'uses' => 'IndexController@addPoints'
]);

Route::get('selfie/{idSelfie}', [
	'uses' => 'IndexController@getSelfie'
]);

Route::get('/user/selfie/{idSelfie}', [
	'uses' => 'IndexController@landingSelfie'
]);

Route::get('user/selfies/{id}', [
	'uses' => 'IndexController@getSelfies'
]);

Route::post('user/selfie/{id}', [
	'uses' => 'IndexController@uploadSelfie'
]);

Route::post('user/delete/{id}', [
	'uses' => 'IndexController@deleteUser'
]);

Route::post('user/edit/{id}', [
	'uses' => 'IndexController@editUser'
]);

Route::post('user/logro/{id}', [
	'uses' => 'IndexController@addLogro'
]);

Route::post('user/share/{id}', [
	'uses' => 'IndexController@addShare'
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

/*
* ----------------------------------
*  Twitter
* ----------------------------------
*/

Route::get('tweets/hashtag/{hashtag}', [
	'uses' => 'TwitterController@tweetsByHashtag'
]);

/*
* ----------------------------------
*  Wordpress
* ----------------------------------
*/

Route::get('wordpress/notas/{page}', [
	'uses' => 'WordpressController@notas'
]);

Route::get('wordpress/nota/{id}', [
	'uses' => 'WordpressController@nota'
]);





