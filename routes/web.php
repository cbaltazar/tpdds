<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return "Hello";
});

Route::get('/dondeinvierto', 'HomeController@index');

Route::get('/loadAccount', 'HomeController@loadAccount');

Route::post('/store', 'FileuploadingController@store');


