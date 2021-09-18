<?php

Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::post('/posts', 'PostController@store');
    Route::get('/posts/create', 'PostController@create');
    Route::put('/posts/{post}', 'PostController@update');
    Route::delete('/posts/{post}', 'PostController@destroy');
    Route::get('/posts/{post}/edit', 'PostController@edit');
    Route::post('/comments', 'CommentController@store');
    Route::get('/contact', 'ContactController@index')->name('contact.index');
    Route::post('/contact/confirm', 'ContactController@confirm')->name('contact.confirm');
    Route::post('/contact/thanks', 'ContactController@send')->name('contact.send');
    });

Route::get('/','PostController@index');
Route::get('/posts/{post}', 'PostController@show')->name('show');