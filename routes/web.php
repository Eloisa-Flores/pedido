<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    //Route::resource('/', 'HomeController');
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/import','HomeController@import')->name('import');
    Route::get('/importData', 'HomeController@importData');
    Route::post('/importData', 'HomeController@import2')->name('importData');
    //---------------------------------------------Exportar -------------------------------------------------------->
    Route::get('/exportar','HomeController@exportar')->name('exportar');
    Route::get('/exportarHistorial','HistorialController@exportar')->name('exportarHistorial');
    Route::get('/exportarPendiente','PendienteController@exportar')->name('exportarPendiente');




    //---------------------------------------------pra home -------------------------------------------------------->
    Route::get('/home','HomeController@index')->name('home');
    Route::post('/home/crearhome','HomeController@store')->name('crearhome');
    Route::put('/home/editarhome','HomeController@update')->name('editarhome');
    Route::delete('/home/borrar','HomeController@destroy')->name('eliminarhome');

    //--------------------------------------------PARA Pendietes Libros ROUTES-------------------------------------------------------->
    Route::get('/LibroPendiente','PrestarLibroController@index2')->name('LibroPendiente');
    Route::put('/LibroPendiente/borrar','PrestarLibroController@destroy2')->name('LibroPendienteborrar');
    Route::post('/LibroPendiente/export', 'PrestarLibroController@export2')->name("exportarLibroPendiente");
    Route::get('/LibroPendiente/export', 'PrestarLibroController@export2')->name("exportarLibroPendiente");


    //--------------------------------------------PARA Empresa ROUTES-------------------------------------------------------->
    Route::get('/empresa','EmpresaController@index')->name('verarea');
    Route::post('/empresa/crearArea','EmpresaController@store')->name('creararea');
    Route::put('/empresa/editarArea','EmpresaController@edit')->name('editararea');
    Route::delete('/empresa/borrarArea','EmpresaController@destroy')->name('borrararea');

//--------------------------------------------PARA Entrega de Pedido ROUTES-------------------------------------------------------->
    Route::put('/entregapedido','HomeController@entrega')->name('entregapedido');
    Route::get('/factura','HomeController@descargar')->name('factura');
    Route::get('/facturaP/{id}','HomeController@descargarP')->name('facturaP');




    //--------------------------------------------PARA Pendientes ROUTES-------------------------------------------------------->
    Route::get('/pendientes','PendienteController@index')->name('pendientes');

    Route::put('/entregapedidos','PendienteController@entrega')->name('entregapedidos');


    //--------------------------------------------PARA Historial ROUTES-------------------------------------------------------->
    Route::get('/historial','HistorialController@index')->name('historial');
    Route::delete('/historial/borrar','HistorialController@destroy')->name('historialborrar');


});
