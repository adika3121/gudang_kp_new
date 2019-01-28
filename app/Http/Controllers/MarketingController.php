<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\master;
use App\tb_outlet;
use App\tb_merek;
use App\tb_kategori;
use App\tb_vendor;
use App\tb_transaksi;
use App\tb_stock_keluar;

class MarketingController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $tb_outlet = tb_outlet::all();
    $tb_kategori = tb_kategori::all();
    return view('dash-marketing.marketing', compact('tb_outlet','tb_kategori'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */

   //////// Melihat Stock Sebuah Outlet
   public function lihat_stock_outlet(Request $request){
     $nama_outlet = tb_outlet::where('kode_outlet',$request->outlet)
                    ->select('nama_outlet as nama')
                    ->first();
     $lihat_stock = master::where('tb_master.kode_outlet', $request->outlet)
                    ->join('tb_outlet', 'tb_outlet.kode_outlet', '=', 'tb_master.kode_outlet')
                    ->select('tb_outlet.nama_outlet as nama_outlet',
                              'tb_master.nama_barang as nama_barang',
                              'tb_master.stock_masuk as stock_masuk',
                              'tb_master.stock_keluar as stock_keluar',
                              'tb_master.sisa_stock as sisa_stock')
                    ->get();
    return view('dash-marketing.marketing_lihatStockOutlet', compact('lihat_stock', 'nama_outlet'));

   }
   ///////////////////////////////////////////////////////////////////////////////////////////////


   ////////// Melihat Stock yang baru masuk sebuah outlet
   public function lihat_stock_masuk_terbaru(Request $request){
     $nama_outlet = tb_outlet::where('kode_outlet',$request->outlet)
                    ->select('nama_outlet as nama')
                    ->first();

    $lihat_stock = master::where('tb_master.kode_outlet', $request->outlet)
                    ->join('tb_outlet', 'tb_outlet.kode_outlet', '=', 'tb_master.kode_outlet')
                    ->join('tb_transaksi', 'tb_transaksi.kode_master', '=', 'tb_master.kode_master')
                    ->select('tb_outlet.nama_outlet as nama_outlet',
                              'tb_master.nama_barang as nama_barang',
                              'tb_transaksi.sn as kode_sn',
                              'tb_transaksi.created_at as waktu_masuk')
                    ->orderByRaw('tb_transaksi.`created_at` DESC')
                    ->get();
    return view('dash-marketing.marketing_masukTerbaru', compact('lihat_stock', 'nama_outlet'));
   }
   //////////////////////////////////////////////////////////////////////////////////////////

   /////////// Melihat Stock yang baru keluar sebuah outlet
   public function lihat_stock_keluar_terbaru(Request $request){
     $nama_outlet = tb_outlet::where('kode_outlet',$request->outlet)
                    ->select('nama_outlet as nama')
                    ->first();
     $lihat_stock = master::where('tb_master.kode_outlet', $request->outlet)
                    ->join('tb_outlet', 'tb_outlet.kode_outlet', '=', 'tb_master.kode_outlet')
                    ->join('tb_stock_keluar', 'tb_stock_keluar.kode_master', '=', 'tb_master.kode_master')
                    ->select('tb_master.nama_barang as nama_barang',
                              'tb_stock_keluar.sn as kode_sn',
                              'tb_stock_keluar.created_at as waktu_masuk')
                    ->orderByRaw('tb_stock_keluar.`created_at` DESC')
                    ->get();
     return view('dash-marketing.marketing_keluarTerbaru', compact('lihat_stock', 'nama_outlet'));
   }
   ///////////////////////////////////////////////////////////////////////////////////////////////////

   ///////////// Melihat Stock Berdasarkan Kategori Barang
   public function lihat_stock_based_type(Request $request){
     $nama_kategori = tb_kategori::where('kode_kategori', $request->kategori)
                      ->select('nama_kategori as nama')
                      ->first();

      $lihat_stock = master::where('kategori', $request->kategori)
                      ->join('tb_kategori', 'tb_kategori.kode_kategori', '=', 'tb_master.kategori')
                      ->join('tb_outlet', 'tb_outlet.kode_outlet', '=', 'tb_master.kode_outlet')
                      ->select('tb_kategori.nama_kategori as nama_kategori',
                                'tb_outlet.nama_outlet as nama_outlet',
                                'tb_master.nama_barang as nama_barang',
                                'tb_master.stock_masuk as stock_masuk',
                                'tb_master.stock_keluar as stock_keluar',
                                'tb_master.sisa_stock as sisa_stock')
                      ->get();
      return view('dash-marketing.marketing_basedType', compact('nama_kategori', 'lihat_stock'));
   }
}
