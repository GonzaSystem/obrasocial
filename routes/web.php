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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Prestador
Route::get('/prestadores', 'PrestadorController@index')->name('prestadores');
Route::get('/datos-prestador', 'PrestadorController@data')->name('datos-prestador');
Route::post('/prestador/create', 'PrestadorController@create')->name('prestador-create');
Route::post('/prestador/update', 'PrestadorController@update')->name('prestador-update');
Route::post('/prestador/list', 'PrestadorController@list')->name('prestador-list');

// Usuario
Route::post('/usuario/update', 'UserController@update')->name('update-usuario');

// Obra Social
Route::get('/obrasocial', 'ObraSocialController@index')->name('obra-social');
Route::post('obrasocial/create', 'ObraSocialController@create')->name('os-create');
Route::post('obrasocial/update', 'ObraSocialController@update')->name('os-update');
Route::post('/obrasocial/list', 'ObraSocialController@list')->name('os-list');

// Beneficiario
Route::get('/beneficiarios/{prestador_id}/{obrasocial_id}/{mes?}/{anio?}', 'BeneficiarioController@index')->name('beneficiarios');
Route::post('/beneficiarios/create', 'BeneficiarioController@create')->name('beneficiario-create');
Route::post('beneficiario/list', 'BeneficiarioController@list')->name('beneficiario-list');
Route::get('beneficiario/presupuesto/{prestador_id}/{beneficiario_id}', 'BeneficiarioController@presupuesto')->name('beneficiario-presupuesto');
Route::post('beneficiario/update', 'BeneficiarioController@update')->name('beneficiario-update');
Route::get('/beneficiario/form/{id}/{prestador_id}/{planilla}/{mes?}/{anio?}', 'BeneficiarioController@formulario')->name('formulario-beneficiario');
Route::get('/beneficiario/delete/{os_id}/{beneficiario_id}', 'BeneficiarioController@delete')->name('beneficiario-delete');
Route::get('/beneficiario/status/{id}/{id_os}/{status}', 'BeneficiarioController@status')->name('beneficiario-status');
Route::post('/beneficiario/traditum', 'BeneficiarioController@traditum')->name('beneficiario-traditum');
Route::post('/beneficiario/inasistencias', 'InasistenciaController@store')->name('beneficiario-inasistencias');
//Prestaciones
Route::get('/prestaciones', 'ObraSocialController@lista_prestaciones')->name('prestaciones');
Route::post('/prestacion/create', 'ObraSocialController@create_prestacion')->name('prestacion-create');
Route::get('/prestacion/show/{id}', 'PrestacionController@show')->name('prestacion-show');
Route::post('/prestacion/edit', 'ObraSocialController@edit')->name('prestacion-edit');
Route::get('/prestacionind/show/{id}', 'ObraSocialController@show')->name('prestacion-ind-show');
Route::get('/prestacion/delete/{id}', 'PrestacionController@destroy')->name('prestacion-delete');

// Sesiones
Route::post('/sesion/horarios', 'SesionController@index')->name('sesion-horarios');
Route::post('/sesion/create', 'SesionController@store')->name('sesion-create');
Route::post('/sesion/destroy', 'SesionController@destroy')->name('sesion-destroy');

// Users
Route::get('/admin/users', 'UserController@showSystemUsers')->name('admin-users');
Route::post('/user/month', 'UserController@saveUserMonth')->name('user-month');

// Video tutoriales
Route::get('/video/tutorials', 'VideoController@index')->name('video-tutorials');
Route::post('/video/create', 'VideoController@store')->name('video-create');
Route::post('/video/update', 'VideoController@update')->name('video-update');
Route::post('/video/list', 'VideoController@list')->name('video-list');
Route::get('/video/delete/{id}', 'VideoController@destroy')->name('video-destroy');
