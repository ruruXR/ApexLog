<?php

Route::get('/','PostController@index');
Route::get('/posts/create', 'PostController@create');
Route::get('/posts/{post}','PostController@show');
Route::get('/posts/{post}/edit', 'PostController@edit');
Route::put('/posts/{post}', 'PostController@update');
Route::post('/posts', 'PostController@store');