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

Route::get('/dataBarang', 'MasterController@index');
Route::resource('/barang', 'MasterController');
Route::resource('/kategori', 'TbKategoriController');
Route::resource('/transaksi', 'TbTransaksiController');
Route::resource('/stock-keluar', 'TbStockKeluarController');
Route::resource('/merk', 'TbMerekController');
Route::resource('/datavendor', 'TbVendorController');
Route::resource('/outlet', 'TbOutletController');
Route::resource('/lainnya', 'DataController');
Route::resource('/master', 'MasterController');
Route::get('/tambah-barang', 'MasterController@create')->name('tambahbarang');
// Stock Keluar
Route::post('/tambah-stock-keluar', 'TbStockKeluarController@tambah_stock_keluar');
Route::post('/tambah-stock-keluar-sn', 'TbStockKeluarController@tambah_sn_keluar');
Route::post('/tambah-stock-keluar-sn-simpan', 'TbStockKeluarController@store');
// Route::get('/transaksi', 'TbTransaksiController@create')->name('transaksi');

// transaksi
Route::post('/tambah-stock','TbTransaksiController@outlet');
Route::post('/tambah-stock-sn', 'TbTransaksiController@tambah_transaksi_sn');
Route::post('/tambah-stock-sn-simpan', 'TbTransaksiController@store');


Route::get('/tesTampil', function () {
    return view('master');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
