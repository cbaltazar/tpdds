<?php

use Illuminate\Http\Request;

//Evaluar indicador
Route::post('/indicatorEvaluate', 'IndicatorController@indicatorEvaluate');

//Evaluar metodologia
Route::post('/methodologyEvaluate', 'MethodologyController@evaluateMethodology');

//Cargar archivo de cuentas.
Route::post('/store', 'AccountController@store');
