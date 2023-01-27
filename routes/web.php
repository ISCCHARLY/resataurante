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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/Menus','MenuController');

//Route::post('/Agrega_menu','MenuController@store');
Route::post('/Agrega_menu','MenuController@store');
Route::post('/Edita_menu','MenuController@update');
Route::post('/Elimina_menu','MenuController@destroy');


Route::resource('/Cartas','CartaController@index');
Route::get('/Carta/{id}','CartaController@show');
Route::post('/Agrega_carta','CartaController@store');
Route::post('/Edita_carta','CartaController@edita');
Route::post('/Modifica_carta','CartaController@update');
Route::post('/Visible','CartaController@estado');
Route::post('/Elimina_carta','CartaController@destroy');



Route::resource('/Agregamesa','MesasController');
Route::post('/aumentamesa','MesasController@store');
Route::post('/eliminamesa','MesasController@destroy');


Route::resource('/Cliente','ClientesController');

Route::resource('/Meseros','MeserosController');
Route::post('/Agrega_mesero','MeserosController@store');
Route::post('/Editar_mesero','MeserosController@edit');
Route::post('/Updated_mesero','MeserosController@update');
Route::post('/Editar_mesero/{id}','MeserosController@estado');
Route::post('/Elimina_mesero','MeserosController@destroy');



Route::resource('/Inventario','InventarioController');
Route::post('/Agrega_inventario','InventarioController@store');

Route::resource('Cambio_cuenta','CuentasController');
Route::post('/Crea_cuenta','CuentasController@crea');
Route::post('/Cambio_cuenta','CuentasController@cambia');

Route::get('/Cuenta/{id}','CuentasController@ver');
Route::post('/Elimina_cuenta/{id}','CuentasController@destroy');
Route::post('/Agregar_Producto','CuentasController@agrega');
Route::post('/Elimina_uno','CuentasController@elimina');
Route::resource('/Guarda','CuentasController');
Route::post('/Guarda_cuenta/{id}','CuentasController@Guarda');

//php artisan make:controller Reportes --resource


Route::resource('/ReporteGeneral','Reportes');
Route::post('/Reporte_fecha','Reportes@porfechas');
//Route::get('/DetalleCuenta/{id}','Reportes@DetalleCuenta');
Route::post('/DetalleCuenta','Reportes@DetalleCuentaajax');

Route::resource('/Ordenes','OrdenesController');
Route::get('/Ordenes/{id}','OrdenesController@Ordenes');
Route::POST('/OrdenChange','OrdenesController@cambio');
Route::post('/ConsultaOrdenjax','OrdenesController@Ordenesajax');
Route::post('/OrdenFinjax','OrdenesController@Ordenfinjax');


Route::resource('/Imprime/cuenta/{id}','ImprimeCuentasController');



