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

Route::get('/', function () {
    return view('welcome');
});
Route::get('auth/facebook', 'Auth\AuthController@redirectToFacebook')->name('auth.facebook');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleFacebookCallback');
Route::get('listfriends', 'Auth\AuthController@getListFriends')->name('listfriends');
Route::get('addnewfeed', 'Auth\AuthController@addNewFeed');
Route::post('postnewfeed', 'Auth\AuthController@postNewFeed')->name('postnewfeed');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
