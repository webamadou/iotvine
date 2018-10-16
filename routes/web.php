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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login/facebook', 'Auth\LoginController@redirectToFacebookProvider')->name('fblog');
Route::get('/login/twitter', 'Auth\LoginController@redirectToTwitterProvider')->name('twtlog');
Route::get('/login/google', 'Auth\LoginController@redirectToGoogleProvider')->name('goolog');

Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');
Route::get('login/twitter/callback', 'Auth\LoginController@handleProviderTwitterCallback');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderGoogleCallback');
