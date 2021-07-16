<?php

use Illuminate\Http\Request;
use Laravel\Passport\Http\Controllers\AccessTokenController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::resource('pais',PaisController::class,['only'=>['index','show']]);
Route::resource('pais.provincias',PaisProvinciaController::class,['only'=>['index']]);
Route::resource('provincias',ProvinciaController::class,['only'=>['index','show']]);
Route::resource('provincias.localidads',ProvinciaLocalidadController::class,['only'=>['index']]);
Route::resource('localidads',LocalidadController::class,['only'=>['index','show']]);
Route::get('users/verify/{token}','UserController@verify')->name('verify');
Route::resource('users',UserController::class,['except'=>['create','edit']]);
Route::resource('agencias',AgenciaController::class,['except'=>['create','edit']]);
Route::resource('seguros',SeguroController::class,['except'=>['create','edit']]);
Route::resource('tipo_coches',TipoCocheController::class,['except'=>['create','edit']]);
Route::resource('agencias.seguros',AgenciaSeguroController::class,['only'=>['index']]);
Route::resource('pais.agencias',PaisAgenciaController::class,['only'=>['index']]);
Route::resource('provincias.agencias',ProvinciaAgenciaController::class,['only'=>['index']]);
Route::resource('localidads.agencias',LocalidadAgenciaController::class,['only'=>['index']]);
Route::resource('agencias.tipo_coches',AgenciaTipoCocheController::class,['only'=>['index']]);
Route::resource('coches',CocheController::class,['except'=>['create','edit']]);
Route::resource('agencias.coches',AgenciaCocheController::class,['only'=>['index']]);
Route::resource('tipo_coches.coches',TipoCocheCocheController::class,['only'=>['index']]);
Route::get('temporadas/{Agencia}/pertenece','TemporadaController@pertenece')->name('temporada.pertenece');
Route::get('temporadas/{Agencia}/puedeReservarse','TemporadaController@puedeReservarse')->name('temporada.puedeReservarse');
Route::resource('temporadas',TemporadaController::class,['except'=>['create','edit','update']]);
Route::get('agencias/{Agencia}/alojamientos/descriptivo','AgenciaAlojamientoController@descriptivo')->name('agencias.alojamientos.descriptivo');
Route::get('alojamientos/{alojamiento}/descriptivo','AlojamientoController@descriptivo')->name('alojamientos.descriptivo');
Route::resource('alojamientos',AlojamientoController::class,['except'=>['create','edit','store']]);
Route::get('agencias/{Agencia}/alojamientos/generar','AgenciaAlojamientoController@generar')->name('agencias.alojamientos.generar');
Route::resource('agencias.alojamientos',AgenciaAlojamientoController::class,['except'=>['create','edit','store','update','destroy']]);
Route::get('agencias/{Agencia}/fechas/abrir','AgenciaFechaController@abrir')->name('agencias.fechas.abrir');
Route::get('agencias/{Agencia}/fechas/cerrar','AgenciaFechaController@cerrar')->name('agencias.fechas.cerrar');
Route::resource('agencias.fechas',AgenciaFechaController::class,['except'=>['create','edit','store','update','destroy']]);
Route::get('clientes/nif','ClienteController@lookforNIF')->name('cliente.nif');
Route::resource('clientes',ClienteController::class,['except'=>['create','edit']]);
Route::resource('tarjetas',TarjetaController::class,['except'=>['create','edit']]);
Route::resource('clientes.tarjetas',ClienteTarjetaController::class,['except'=>['create','edit','store','update','destroy']]);
Route::resource('reservas',ReservaController::class,['except'=>['create','edit']]);
Route::resource('clientes.reservas',ClienteReservaController::class,['except'=>['create','edit','store','update','destroy']]);
Route::resource('agencias.reservas',AgenciaReservaController::class,['except'=>['create','edit','store','show','update','destroy']]);
Route::get('coches/{coche}/fechas/libre','CocheFechasController@libre')->name('coches.fechas.libre');
Route::get('coches/{coche}/fechas/ocupado','CocheFechasController@ocupado')->name('coches.fechas.ocupado');
Route::resource('coches.fechas',CocheFechasController::class,['except'=>['create','edit','store','update','destroy']]);
Route::resource('coches.reservas',CocheReservaController::class,['except'=>['create','edit','store','update','destroy']]);
Route::resource('coches.alojamientos',CocheAlojamientoController::class,['except'=>['create','edit','store','update','destroy']]);
Route::post('oauth/token','\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken')->name('passport.token');
Route::get('alojamientos/{alojamiento}/coches/fechas','AlojamientoCocheController@fechas')->name('alojamientos.coches.fechas');
Route::resource('alojamientos.coches',AlojamientoCocheController::class,['only'=>['index','show']]);
Route::resource('alojamientos.agencias',AlojamientoAgenciaController::class,['only'=>['index']]);
Route::post('reservas/fechas','ReservaFechaController@store')->name('reservas.fechas.store');
