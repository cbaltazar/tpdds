<?php

use Illuminate\Http\Request;

//Evaluar indicador
Route::post('/indicatorEvaluate', 'IndicatorController@indicatorEvaluate');

//Evaluar metodologia
Route::post('/methodologyEvaluate', 'MethodologyController@evaluateMethodology');