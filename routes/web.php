<?php

Route::get('/lockscreen', 'FrontController@lockscreen');

Route::get('/', function(){
      return redirect('/loadAccounts');
});


//ACCOUNT
Route::get('/loadAccounts', 'FrontController@loadAccounts');

Route::post('/store', 'FileuploadingController@store');

Route::get('/viewAccounts', 'FrontController@viewAccounts');

Route::get('/accountDetail', 'FrontController@accountDetail');

Route::post('/store', 'FileUploaderController@store');

//INDICATORS

Route::get('/methodDetail', 'FrontController@methodDetail');

Route::get('/methodList', 'FrontController@methodList');

//METODOLOGIES

Route::get('/indicatorDetail', 'FrontController@indicatorDetail');

Route::get('/indicatorList', 'FrontController@indicatorList');
