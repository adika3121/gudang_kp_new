<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_transaksi;
use App\tb_vendor;
use App\master;
use App\tb_outlet;
use App\tb_merek;
use App\tb_kategori;

class TbTransaksiController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $tampilTransaksi = tb_transaksi::with('tb_vendor', 'master')
                      ->get();
      $tb_outlet = tb_outlet::all();
      $vendor=tb_vendor::all();
      // $tampilBRG = DB
      return view('Transaksi.tampil_transaksi', compact('tampilTransaksi', 'tb_outlet', 'vendor'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function outlet(Request $request){
    $nama_outlet = $request->outlet;
    $outlet = tb_outlet::all();
    $nama_barang = master::where('kode_outlet', $nama_outlet)
                    -> select('tb_master.id_master as id_master', 'tb_master.kode_master as kode_master', 'tb_master.nama_barang as nama_barang')
                    -> get();
    $vendor = tb_vendor::all();

    return view('Transaksi.tambah_transaksi', compact('nama_outlet', 'outlet', 'nama_barang', 'vendor'));
  }

  public function tambah_transaksi_sn(Request $request){
    $nama_outlet = $request->outlet;
    $id_master = $request->id_master;
    $vendor = $request->kode_vendor;
    $kk_master = master::where('id_master', $id_master)
                  ->select('tb_master.kode_master as kode_master')
                  ->first();
    $kode_master = $kk_master->kode_master;
    return view('Transaksi.sn_transaksi', compact('nama_outlet', 'kode_master', 'id_master', 'vendor'));
  }

  // public function create(Request $request)
  // {
  //   $nama_outlet = $request->outlet;
  //   $outlet = tb_outlet::all();
  //   $nama_barang = master::where('kode_outlet', $nama_outlet)
  //                   -> select('tb_master.kode_master as kode_master', 'tb_master.nama_barang as nama_barang')
  //                   -> get();
  //   $vendor = tb_vendor::all();
  //
  //   return view('tambah_transaksi', compact('nama_outlet', 'outlet', 'nama_barang', 'vendor'));
  // }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      // hasil oper dari view sebelumnya
      $nama_outlet = $request->nama_outlet;
      $id_master = $request->id_master;
      $vendor = $request->vendor;
      $k_master = master::where('id_master', $id_master)
                    ->select('tb_master.kode_master as kode_master')
                    ->first();
      $kode_master = $k_master->kode_master;

      // Simpan ke db
      $transaksi = new tb_transaksi();
      $transaksi->kode_master = $k_master->kode_master;
      $transaksi->sn = $request->sn;
      $transaksi->vendor = $vendor;
      $transaksi->keterangan = $request->keterangan;
      $transaksi->save();

      // input stock masuk ke tb_master
      $master = master::find($id_master);
      $input_stock = tb_transaksi::where('kode_master', $kode_master)
                    ->count();
      $master->stock_masuk = $input_stock;
      $master->save();

      return view('Transaksi.sn_transaksi', compact('nama_outlet', 'kode_master',  'id_master', 'vendor'));

  }

  /**
   * Display the specified resource.
   *
   * @param  \App\tb_transaksi  $tb_vendor
   * @return \Illuminate\Http\Response
   */
  public function show(tb_transaksi $tb_transaksi)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\tb_transaksi  $tb_vendor
   * @return \Illuminate\Http\Response
   */
  public function edit(tb_transaksi $tb_transaksi)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\tb_transaksi  $tb_vendor
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request)
   {
       $transaksi = tb_transaksi::findOrFail($request->kode_transaksi);

       $transaksi->update($request->all());
       return back();
   }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\tb_transaksi  $tb_vendor
   * @return \Illuminate\Http\Response
   */

   public function destroy(Request $request)
   {
       $transaksi = tb_transaksi::findOrFail($request->kode_transaksi);
       $transaksi->delete();

       $id_master = master::where('kode_master', $request->kode_master)
                    ->select('tb_master.id_master as id_master')
                    ->first();
       $master = master::find($id_master->id_master);
       $delete_stock = tb_transaksi::where('kode_master', $request->kode_master)
                     ->count();
       $master->stock_masuk = $delete_stock;
       $master->save();

       return back();
   }
}
