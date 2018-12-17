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

Route::get('/', 'ContestController@index');

Auth::routes();

Route::get('/home', 'ContestController@index')->name('home');
Route::get('/{slug}/index.html', 'ContestController@contest_public')->name('contest_url');
Route::get('/contests', 'ContestController@index')->name('contests');
//Here we set up the route to login with fb twt and g+
Route::get('/login/facebook', 'Auth\LoginController@redirectToFacebookProvider')->name('fblog');
Route::get('/login/twitter', 'Auth\LoginController@redirectToTwitterProvider')->name('twtlog');
Route::get('/login/google', 'Auth\LoginController@redirectToGoogleProvider')->name('goolog');
//Here are the callback links for the social authentications
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');
Route::get('login/twitter/callback', 'Auth\LoginController@handleProviderTwitterCallback');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderGoogleCallback');
//list of contest routes
Route::get('contest/create', 'ContestController@create')->name('create_contest');
Route::delete('contests/{slug}', 'ContestController@destroy')->name('deletes_contest');
Route::get('contest/{slug}', 'ContestController@show')->name('contest_show');
Route::get('contest/{slug}/configs', 'ContestController@edit')->name('edit_contest');
Route::post('contestUpdaterPageOne', 'ContestController@updatePageOne')->name('contestUpdaterPageOne');
Route::get('contestUpdaterPageTwo/{slug}', 'ContestController@editPageTwo')->name('editPageTwo');
Route::post('contestUpdaterPageTwo', 'ContestController@updatePageTwo');
Route::get('contestUpdaterPageThree/{slug}', 'ContestController@editPageThree');
Route::post('contestUpdaterPageThree', 'ContestController@updatePageThree');
Route::post('storePrize','PrizeController@store')->name('storePrize') ;
