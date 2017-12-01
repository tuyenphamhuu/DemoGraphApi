<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'auth'], function() {
    Route::get('facebook', 'Auth\AuthController@redirectToFacebook')->name('auth.facebook');
    Route::get('facebook/callback', 'Auth\AuthController@handleFacebookCallback');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('listfriends', 'Auth\AuthController@getListFriends')->name('listfriends');
    Route::get('addnewfeed', 'Auth\AuthController@addNewFeed')->name('addnewfeed');
    Route::post('postnewfeed', 'Auth\AuthController@postNewFeed')->name('postnewfeed');
    Route::get('likefirstnf/{id}', 'Auth\AuthController@like')->name('likefirstnf');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
