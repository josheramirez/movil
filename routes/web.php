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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@enrutador')->name('enrutador');
Route::get('/trabajador', 'HomeController@index')->name('trabajador');
Route::get('/buscarViaje/{id}', 'HomeController@buscarViaje')->name('home.buscarViaje');
Route::post('/editarSolicitud', 'HomeController@editarSolicitud')->name('usuario.editarSolicitud');
Route::get('/solicitudes', 'HomeController@solicitudesBuscar')->name('usuario.solicitudesBuscar');


// AdministradorController
Route::get('/administrador', 'AdministradorController@index')->name('administrador');
Route::get('/administrador/buscarMovil/{id}', 'AdministradorController@buscarMovil')->name('administrador.buscarMovil');
Route::post('/administrador/asignarMovil','AdministradorController@asignarMovil')->name('administrador.asignarMovil');
Route::post('/administrador/nuevoMovil','AdministradorController@nuevoMovil')->name('administrador.nuevoMovil');
Route::get('/administrador/buscarDia/{dia}','AdministradorController@buscarDia')->name('administrador.buscarDia');

// ViajesController
Route::post('solicitud/add', 'SolicitudController@store')->name('solicitud.store');
Route::get('solicitud/{id}', 'SolicitudController@editarSolicitud')->name('solicitud.editarSolicitud');

Route::resource('post','PostController');
