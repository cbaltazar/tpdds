<?php

use Illuminate\Http\Request;

//Evaluar indicador
Route::post('/indicatorEvaluate', 'IndicatorController@indicatorEvaluate');

//Guardar Metodologia
Route::post('/saveMethodology', 'MethodologyController@post');