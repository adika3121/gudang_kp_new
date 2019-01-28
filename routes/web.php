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


// Pengguna Sistem
Route::resource('/pengguna', 'penggunaController');

Route::get('/tambah-barang', 'MasterController@create')->name('tambahbarang');
=======
Auth::routes();
>>>>>>> 4a4b2c2866f1ab138ccda6d7ec134572df7f59b1



Route::group(['middleware' => 'auth'], function(){

    Route::resource('/', 'HomeController');
    Route::get('/home', 'HomeController@index')->name('home');
    // Route::get('/dataBarang', 'MasterController@index');
    // Route::resource('/barang', 'MasterController');
    Route::resource('/kategori', 'TbKategoriController');
    Route::resource('/transaksi', 'TbTransaksiController');
    Route::resource('/stock-keluar', 'TbStockKeluarController');
    Route::resource('/merk', 'TbMerekController');
    Route::resource('/datavendor', 'TbVendorController');
    Route::resource('/outlet', 'TbOutletController');
    Route::resource('/master', 'MasterController');
    Route::resource('/lainnya', 'DataController');
    Route::resource('/dashboard', 'dashboardController');

    // Route::get('/tambah-barang', 'MasterController@create')->name('tambahbarang');
    // Stock Keluar
    Route::post('/tambah-stock-keluar', 'TbStockKeluarController@tambah_stock_keluar');
    Route::post('/tambah-stock-keluar-sn', 'TbStockKeluarController@tambah_sn_keluar');
    Route::post('/tambah-stock-keluar-sn-simpan', 'TbStockKeluarController@store');
    // Route::get('/transaksi', 'TbTransaksiController@create')->name('transaksi');

    // transaksi
    Route::post('/tambah-stock','TbTransaksiController@outlet');
    Route::post('/tambah-stock-sn', 'TbTransaksiController@tambah_transaksi_sn');
    Route::post('/tambah-stock-sn-simpan', 'TbTransaksiController@store');

    // dashboard
    Route::post('/lihat-stock-outlet', 'dashboardController@lihat_stock_outlet');
    Route::post('/lihat-stock-masuk-dash', 'dashboardController@lihat_stock_masuk_terbaru');
    Route::post('/lihat-stock-keluar-dash', 'dashboardController@lihat_stock_keluar_terbaru');
    Route::post('/lihat-stock-based-type-dash', 'dashboardController@lihat_stock_based_type');
 });


Route::get('/tesTampil', function () {
    return view('auth.register');
=======
Route::group(['prefix' => 'admin', 'middleware'=> ['auth' => 'admin']], function () {



});


<<<<<<< HEAD
Route::get('/home', 'HomeController@index')->name('home');
=======

// Route::get('/tesTampil', function () {
//     return view('dashboard.dashboard');
// });


>>>>>>> 4a4b2c2866f1ab138ccda6d7ec134572df7f59b1
