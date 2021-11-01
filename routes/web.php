<?php

Auth::routes(['verify' => true]);
Route::get('login/twitter', 'Auth\LoginController@redirectToTwitterProvider');
Route::get('login/twitter/callback', 'Auth\LoginController@handleTwitterProviderCallback');
Route::group(['middleware' => 'auth'], function(){
// Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/posts', 'PostController@store');
    Route::get('/posts/create', 'PostController@create');
    Route::put('/posts/{post}', 'PostController@update');
    Route::delete('/posts/{post}', 'PostController@destroy');
    Route::get('/posts/{post}/edit', 'PostController@edit');
    Route::get('/posts/{post}/tweet', 'TwitterController@tweet');
    Route::post('/comments', 'CommentController@store');
    Route::post('/like/{post}', 'LikeController@like');
    Route::post('/unlike/{post}', 'LikeController@unlike');
    Route::get('/profile/{user}', 'profileController@profile');
    Route::get('/contact', 'ContactController@index')->name('contact.index');
    Route::post('/contact/confirm', 'ContactController@confirm')->name('contact.confirm');
    Route::post('/contact/thanks', 'ContactController@send')->name('contact.send');
    });

Route::get('/','PostController@index');
Route::get('/posts/{post}', 'PostController@show')->name('show');