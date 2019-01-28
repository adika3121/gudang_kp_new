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
Route::resource('/', 'HomeController');
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
Route::resource('/dashboard', 'dashboardController');
Route::resource('/', 'HomeController');
Route::resource('/marketing', 'MarketingController');
Route::resource('/penerimaan-master', 'PenerimaanMasterController');
Route::resource('/penerimaan-transaksi', 'PenerimaanTransaksiController');
Route::resource('/pengiriman-stock-keluar', 'PengirimanStockKeluarController');
Route::resource('/pengiriman-master', 'PengirimanMasterController');

// Pengguna Sistem
Route::resource('/pengguna', 'penggunaController');

Route::get('/tambah-barang', 'MasterController@create')->name('tambahbarang');

// Stock Keluar
Route::post('/tambah-stock-keluar', 'TbStockKeluarController@tambah_stock_keluar');
Route::post('/tambah-stock-keluar-sn', 'TbStockKeluarController@tambah_sn_keluar');
Route::post('/tambah-stock-keluar-sn-simpan', 'TbStockKeluarController@store');
// Route::get('/transaksi', 'TbTransaksiController@create')->name('transaksi');

// Pengiriman Stock Keluar
Route::post('/pengiriman-tambah-stock-keluar', 'PengirimanStockKeluarController@tambah_stock_keluar');
Route::post('/pengiriman-tambah-stock-keluar-sn', 'PengirimanStockKeluarController@tambah_sn_keluar');
Route::post('/pengiriman-tambah-stock-keluar-sn-simpan', 'PengirimanStockKeluarController@store');

// transaksi
Route::post('/tambah-stock','TbTransaksiController@outlet');
Route::post('/tambah-stock-sn', 'TbTransaksiController@tambah_transaksi_sn');
Route::post('/tambah-stock-sn-simpan', 'TbTransaksiController@store');

// penerimaan transaksi
Route::post('/penerimaan-tambah-stock','PenerimaanTransaksiController@outlet');
Route::post('/penerimaan-tambah-stock-sn', 'PenerimaanTransaksiController@tambah_transaksi_sn');
Route::post('/penerimaan-tambah-stock-sn-simpan', 'PenerimaanTransaksiController@store');

// dashboard
Route::post('/lihat-stock-outlet', 'dashboardController@lihat_stock_outlet');
Route::post('/lihat-stock-masuk-dash', 'dashboardController@lihat_stock_masuk_terbaru');
Route::post('/lihat-stock-keluar-dash', 'dashboardController@lihat_stock_keluar_terbaru');
Route::post('/lihat-stock-based-type-dash', 'dashboardController@lihat_stock_based_type');

// marketing dashboard
Route::post('/marketing-lihat-stock-outlet', 'MarketingController@lihat_stock_outlet');
Route::post('/marketing-lihat-stock-masuk-dash', 'MarketingController@lihat_stock_masuk_terbaru');
Route::post('/marketing-lihat-stock-keluar-dash', 'MarketingController@lihat_stock_keluar_terbaru');
Route::post('/marketing-lihat-stock-based-type-dash', 'MarketingController@lihat_stock_based_type');

Route::get('/tesTampil', function () {
    return view('auth.register');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
