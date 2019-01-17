<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_stock_keluar;
use App\tb_outlet;
use App\master;

class TbStockKeluarController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $stock_keluar = tb_stock_keluar::all();
    $tb_outlet = tb_outlet::all();
    return view('stock_keluar.tampil_stockKeluar', compact('stock_keluar', 'tb_outlet'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function tambah_stock_keluar(Request $request){
     $nama_outlet = $request->outlet;
     $nama_barang = master::where('kode_outlet', $nama_outlet)
                   -> select('tb_master.id_master as id_master','tb_master.kode_master as kode_master', 'tb_master.nama_barang as nama_barang')
                   -> get();
     return view('tambah_stock_keluar', compact('nama_barang','nama_outlet'));
   }

   public function tambah_sn_keluar(Request $request){
     $nama_outlet = $request->outlet;
     $id_master = $request->id_master;
     $kk_master = master::where('id_master', $id_master)
                   ->select('tb_master.kode_master as kode_master')
                   ->first();
     $kode_master = $kk_master->kode_master;
     $ket = $request->keterangan;
     return view('sn_stockKeluar', compact('nama_outlet', 'kode_master', 'ket', 'id_master'));
   }

  public function create(Request $request)
  {
      $nama_outlet = $request->outlet;
      $nama_barang = master::where('kode_outlet', $nama_outlet)
                    -> select('tb_master.kode_master as kode_master', 'tb_master.nama_barang as nama_barang')
                    -> get();
      return view('tambah_stock_keluar', compact('nama_barang'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  // public function simpan_transaksi_baru(Request $request){
  //   foreach($request->input('sn')as $key => $value){
  //     foreach($request->input('kode_master')as $key =>$value_master){
  //       foreach($request->input('keterangan')as $key=>$value_keterangan){
  //         tb_stock_keluar::create(['sn'=>$value],['kode_master'=>$value_master], ['keterangan'=>$value_keterangan]);
  //       }
  //     }
  //
  //
  //   }
  //   return redirect('/stock-keluar');
  // }

  public function store(Request $request)
  {
      $id_master = $request->id_master;
      $kk_master = master::where('id_master', $id_master)
                    ->select('tb_master.kode_master as kode_master')
                    ->first();
      $nama_outlet = $request->outlet;
      $kode_master = $request->kode_master;
      $ket = $request->keterangan;
      $stock_out = new tb_stock_keluar();
      $stock_out->sn = $request->sn;
      $stock_out->kode_master = $request->kode_master;
      $stock_out->keterangan = $request->keterangan;
      $stock_out->save();

      $master = master::find($id_master);
      $out_stock = tb_stock_keluar::where('kode_master', $kode_master)
                    ->count();
      $master->stock_keluar = $out_stock;
      $master->save();

      return view('sukses_stockKeluar', compact('nama_outlet', 'kode_master', 'ket', 'id_master'));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\tb_stock_keluar $tb_vendor
   * @return \Illuminate\Http\Response
   */
  public function show(tb_vendor $tb_stock_keluar)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\tb_vendor  $tb_vendor
   * @return \Illuminate\Http\Response
   */
  public function edit(tb_vendor $tb_stock_keluar)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\tb_vendor  $tb_vendor
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\tb_vendor  $tb_vendor
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {

  }
}
