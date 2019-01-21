<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use View;
use DB;
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
     return view('stock_keluar.tambah_stock_keluar', compact('nama_barang','nama_outlet'));
   }

   public function tambah_sn_keluar(Request $request){
     $nama_outlet = $request->outlet;
     $id_master = $request->id_master;
     $kk_master = master::where('id_master', $id_master)
                   ->select('tb_master.kode_master as kode_master')
                   ->first();
     $kode_master = $kk_master->kode_master;
     return view('stock_keluar.sn_stockKeluar', compact('nama_outlet', 'kode_master', 'id_master'));
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

      $stock_out = [
        "errors" => null
      ];
      $validator = Validator::make(Input::all(),  tb_stock_keluar::Rules(), tb_stock_keluar::$messages);
      if($validator->passes()){
        ///// Data dari view sebelumnya
        $id_master = $request->id_master;
        $kk_master = master::where('id_master', $id_master)
                      ->select('tb_master.kode_master as kode_master')
                      ->first();
        $nama_outlet = $request->outlet;
        $kode_master = $request->kode_master;
        //////////////////////////////////////

        ///// Simpan ke DB
        $stock_out = new tb_stock_keluar();
        $stock_out->sn = Input::get('sn');
        $stock_out->kode_master = Input::get('kode_master');
        $stock_out->keterangan = Input::get('keterangan');
        $stock_out->save();
        /////////////////////

        ///// Menghitung jumlah stock keluar untuk dimasukan ke tb_master
        $master = master::find($id_master);
        $out_stock = tb_stock_keluar::where('kode_master', $kode_master)
                      ->count();
        $master->stock_keluar = $out_stock;
        $master->save();
        $total_stock = master::where('id_master',$id_master)
                        ->select(DB::raw('tb_master.stock_masuk - tb_master.stock_keluar as total'))
                        ->first();
        $master->sisa_stock = $total_stock->total;
        $master->save();
        //////////////////////////////////////



        return view('stock_keluar.sukses_stockKeluar', compact('nama_outlet', 'kode_master', 'ket', 'id_master', 'stock_out'));

      }else{
        ///// Data dari view sebelumnya
        $id_master = Input::get('id_master');
        $kk_master = master::where('id_master', $id_master)
                      ->select('tb_master.kode_master as kode_master')
                      ->first();
        $nama_outlet = Input::get('outlet');
        $kode_master = $kk_master->kode_master;
        //////////////////////////////////////

        $stock_out = $validator->errors();
        $data = compact('id_master', 'kk_master', 'nama_outlet', 'kode_master');

        return View::make('stock_keluar.sn_stockKeluar', $data)->withErrors($validator);

      }







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
    $stock_keluar = tb_stock_keluar::findOrFail($request->kode_keluar);

    $stock_keluar->update($request->all());
    return back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\tb_vendor  $tb_vendor
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
      $stock_keluar = tb_stock_keluar::findOrFail($request->kode_keluar);
      $stock_keluar->delete();

      ///////////// Mengupdate nilai di master
      $id_master = master::where('kode_master', $request->kode_master)
                   ->select('tb_master.id_master as id_master')
                   ->first();
        ////////// Update nilai stock keluar
      $master = master::find($id_master->id_master);
      $delete_stock = tb_stock_keluar::where('kode_master', $request->kode_master)
                    ->count();
      $master->stock_keluar = $delete_stock;
      $master->save();
        ////////////////////////////////////
        ///////// Update nilai total_stock
      $total_stock = master::where('id_master',$id_master->id_master)
                      ->select(DB::raw('tb_master.stock_masuk - tb_master.stock_keluar as total'))
                      ->first();
      $master->sisa_stock = $total_stock->total;
      $master->save();
      /////////////////////////////////////////////////
      return back();
  }
}
