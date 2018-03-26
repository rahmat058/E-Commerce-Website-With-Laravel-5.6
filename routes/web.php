<?php

// Frontend Site Route............................................
Route::get('/', 'HomeController@index');














// Backend Site Route..............................................
Route::get('/admin', 'AdminController@index');
