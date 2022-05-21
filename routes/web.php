<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('layouts/main');
});*/


Route::get('/', 'HomeController@index');

Route::get('/periodos', 'PeriodoController@index');
Route::get('/periodos/get-all', 'PeriodoController@getAll');
Route::post('/periodos/create', 'PeriodoController@create');
Route::post('/periodos/update', 'PeriodoController@update');

Route::get('/ciclos', 'CicloController@index');
Route::get('/ciclos/get-all', 'CicloController@getAll');
Route::post('/ciclos/create', 'CicloController@create');
Route::post('/ciclos/update', 'CicloController@update');
