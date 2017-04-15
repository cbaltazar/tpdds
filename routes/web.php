<?php

Route::get('/dondeinvierto', 'HomeController@index');

Route::get('/loadAccount', 'HomeController@loadAccount');

Route::get('/viewAccount', 'HomeController@viewAccount');

Route::post('/store', 'FileUploaderController@store');


