<?php

//GENERAL
Route::get('/lockscreen', 'FrontController@lockscreen');
Route::get('/', function(){ return redirect('/loadAccounts'); });

//ACCOUNT
Route::get('/loadAccounts', 'FrontController@loadAccounts');
Route::get('/viewAccounts', 'FrontController@viewAccounts');
Route::get('/accountDetail/{company?}', 'FrontController@accountDetail');

//ABM ACCOUNT
Route::post('/store', 'AccountController@store');

//ABM COMPANIES
Route::get('/deleteCompany/{id}', 'CompanyController@deleteCompany');

//INDICATORS
Route::get('/indicatorList', 'FrontController@indicatorList');
Route::get('/indicatorDetail/{id?}', 'FrontController@indicatorDetail');

//ABM INDICATORS
Route::post('/indicatorSave/{id?}', 'IndicatorController@indicatorSave');
Route::get('/indicatorDelete/{id}', 'IndicatorController@indicatorDelete');

//METODOLOGIES
Route::get('/methodDetail', 'FrontController@methodDetail');
Route::get('/methodList', 'FrontController@methodList');

//TEST FORMULA
Route::get('/pruebaBase', 'FrontController@pruebaBase');