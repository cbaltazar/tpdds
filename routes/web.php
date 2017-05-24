<?php

//GENERAL

Route::get('/lockscreen', 'FrontController@lockscreen');

Route::get('/', function(){ return redirect('/loadAccounts'); });

//ACCOUNT

Route::get('/loadAccounts', 'FrontController@loadAccounts');

Route::get('/viewAccounts', 'FrontController@viewAccounts');

Route::get('/accountDetail/{company?}', 'FrontController@accountDetail');

Route::post('/store', 'FileUploaderController@store');

//METODOLOGIES

Route::get('/methodDetail', 'FrontController@methodDetail');

Route::get('/methodList', 'FrontController@methodList');

//INDICATORS
Route::post('/indicatorSave', 'IndicatorController@indicatorSave');

Route::get('/indicatorEvaluate', 'IndicatorController@indicatorEvaluate');

Route::get('/indicatorDetail', 'FrontController@indicatorDetail');

Route::get('/indicatorList', 'FrontController@indicatorList');

Route::get('/pruebaBase', 'FrontController@pruebaBase');
