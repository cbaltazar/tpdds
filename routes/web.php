<?php

//php
Route::get('/phpinfo', function(){ return phpinfo(); });

//GENERAL
Route::get('/lockscreen', 'FrontController@lockscreen');
Route::get('/', function(){ return redirect('/companyList'); });


Route::get('/calcular', 'FrontController@calcular');



//COMPANIES
Route::get('/companyList', 'FrontController@companyList');
Route::get('/companyDetail/{company?}', 'FrontController@companyDetail');

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

//METHODOLOGIES
Route::get('/methodDetail/{id?}', 'FrontController@methodDetail');
Route::get('/methodList', 'FrontController@methodList');

//ABM METHODOLOGIES
Route::post('/saveMethodology/{id?}', 'MethodologyController@saveMethodology');
Route::get('/deleteMethodology/{id}', 'MethodologyController@deleteMethodology');

