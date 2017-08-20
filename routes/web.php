<?php

//php
Route::get('/phpinfo', function(){ return phpinfo(); });

//GENERAL
Auth::routes();
Route::get('/lockscreen', 'FrontController@lockscreen');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', function(){ return redirect('/companyList'); })->middleware('auth');
Route::get('/calcular', 'FrontController@calcular')->middleware('auth');

//COMPANIES
Route::get('/companyList', 'FrontController@companyList')->middleware('auth');
Route::get('/companyDetail/{company?}', 'FrontController@companyDetail')->middleware('auth');

//ABM ACCOUNT
Route::post('/store', 'AccountController@store')->middleware('auth');

//ABM COMPANIES
Route::get('/deleteCompany/{id}', 'CompanyController@deleteCompany')->middleware('auth');

//INDICATORS
Route::get('/indicatorList', 'FrontController@indicatorList')->middleware('auth');
Route::get('/indicatorDetail/{id?}', 'FrontController@indicatorDetail')->middleware('auth');

//ABM INDICATORS
Route::post('/indicatorSave/{id?}', 'IndicatorController@indicatorSave')->middleware('auth');
Route::get('/indicatorDelete/{id}', 'IndicatorController@indicatorDelete')->middleware('auth');

//METHODOLOGIES
Route::get('/methodDetail/{id?}', 'FrontController@methodDetail')->middleware('auth');
Route::get('/methodList', 'FrontController@methodList')->middleware('auth');
Route::get('/methodEval','FrontController@methodEval')->middleware('auth');

//ABM METHODOLOGIES
Route::post('/saveMethodology/{id?}', 'MethodologyController@saveMethodology')->middleware('auth');
Route::get('/deleteMethodology/{id}', 'MethodologyController@deleteMethodology')->middleware('auth');
