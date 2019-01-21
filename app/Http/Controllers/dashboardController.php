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

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tb_outlet = tb_outlet::all();
      return view('dashboard.dashboard', compact('tb_outlet'));
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
      return view('dashboard.dashboard_lihatStockOutlet', compact('lihat_stock', 'nama_outlet'));

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
      return view('dashboard.dashboard_masukTerbaru', compact('lihat_stock', 'nama_outlet'));
     }
     /////////////////////////////////////////////////////////////////////////////////////////

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
       return view('dashboard.dashboard_keluarTerbaru', compact('lihat_stock', 'nama_outlet'));
     }
     ///////////////////////////////////////////////////////////////////////////////////////////////////


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
