<?php

// Frontend Site Route............................................
Route::get('/', 'HomeController@index');














// Backend Site Route..............................................
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
