<?php

use Illuminate\Support\Facades\Route;


// INICIO
Route::get('/', function () {
    return view('auth.login');
})->name('home');
// LOGIN
Route::get('/login', function () {
    return view('auth.login');
})->name('login');


// GROUP
Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard','OptionController@index')->name('dashboard');
    Route::get('/venta/factura/{id}','Venta\ComprobanteController@facturaVista')->name('venta.factura');
    Route::get('/venta/list/factura','Venta\ComprobanteController@listarFactura')->name('venta.listar.factura');
    Route::get('/venta/detalle/factura','Venta\ComprobanteController@detalleFactura')->name('venta.detalle.factura');
});

Route::auth();

