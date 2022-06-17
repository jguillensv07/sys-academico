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
Route::get('/periodos/{periodo}/detalle', 'PeriodoController@detail');
Route::get('/periodos/{periodo}/detalle/get-all', 'PeriodoController@ciclosGetAll');
Route::post('/periodos/{periodo_id}/detalle/agregar-ciclo', 'PeriodoController@agregarCiclo');
Route::post('/periodos/{periodo}/cambiar-estado', 'PeriodoController@cambiarEstado');
Route::get('/periodos/{periodo}/detalle/aperturar-ciclo-partial', 'PeriodoController@aperturarCicloPartial');
Route::post('/periodos/{periodo}/detalle/aperturar-ciclo-partial', 'PeriodoController@aperturarCiclo');


Route::get('/ciclos', 'CicloController@index');
Route::get('/ciclos/get-all', 'CicloController@getAll');
Route::post('/ciclos/create', 'CicloController@create');
Route::post('/ciclos/update', 'CicloController@update');

Route::get('/materias', 'MateriaController@index');
Route::get('/materias/get-all', 'MateriaController@getAll');
Route::post('/materias/create', 'MateriaController@create');
Route::post('/materias/update', 'MateriaController@update');


Route::get('/estudiantes', 'EstudianteController@index');
Route::get('/estudiantes/get-all', 'EstudianteController@getAll');
Route::get('/estudiantes/get-all-admision-aprobada', 'EstudianteController@getAllAdmisionAprobada');
Route::post('/estudiantes/create', 'EstudianteController@create');
Route::post('/estudiantes/update', 'EstudianteController@update');
Route::post('/estudiantes/{estudiante_id}/generar-solicitud-admision', 'EstudianteController@generarSolicitudAdmision');


Route::get('/solicitudes-de-admision', 'SolicitudAdmisionController@index');
Route::get('/solicitudes-de-admision/get-all', 'SolicitudAdmisionController@getAll');
Route::post('/solicitudes-de-admision/{solicitud_id}/aprobar', 'SolicitudAdmisionController@aprobarSolicitud');
Route::post('/solicitudes-de-admision/{solicitud_id}/denegar', 'SolicitudAdmisionController@denegarSolicitud');

Route::get('/inscripciones', 'InscripcionController@index');
Route::get('/inscripciones/nuevo', 'InscripcionController@create');
Route::get('/inscripciones/editar/{inscripcion_id}', 'InscripcionController@edit');
Route::get('/inscripciones/get-all', 'InscripcionController@getAll');
Route::post('/inscripciones/nuevo', 'InscripcionController@store');
Route::post('/inscripciones/editar/{inscripcion_id}', 'InscripcionController@update');


Route::get('/colector-de-notas', 'NotasController@index');
Route::get('/colector-de-notas/listar-estudiantes', 'NotasController@listadoEstudiantesPartial');

