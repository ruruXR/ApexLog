<?php

Route::get('/','PostController@index');
Route::get('/posts/{post}','PostController@show');