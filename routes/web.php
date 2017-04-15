<?php

Route::get('/dondeinvierto', 'HomeController@index');

Route::get('/loadAccounts', 'HomeController@loadAccounts');

Route::get('/viewAccounts', 'HomeController@viewAccounts');

Route::post('/store', 'FileUploaderController@store');


