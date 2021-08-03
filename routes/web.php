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

Route::group(['middleware' => 'auth'], function () {

    Route::resource('/home', 'HomeController');
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/exportar','HomeController@exportar')->name('exportar');
    Route::get('/import','HomeController@import')->name('import');
    Route::get('/importData', 'HomeController@importData');
    Route::post('/importData', 'HomeController@importData');


    //--------------------------------------------PARA Pendietes Libros ROUTES-------------------------------------------------------->
    Route::get('/LibroPendiente','PrestarLibroController@index2')->name('LibroPendiente');
    Route::put('/LibroPendiente/borrar','PrestarLibroController@destroy2')->name('LibroPendienteborrar');
    Route::post('/LibroPendiente/export', 'PrestarLibroController@export2')->name("exportarLibroPendiente");
    Route::get('/LibroPendiente/export', 'PrestarLibroController@export2')->name("exportarLibroPendiente");
});
