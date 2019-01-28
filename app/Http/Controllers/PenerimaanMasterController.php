<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\master;
use App\tb_outlet;
use App\tb_merek;
use App\tb_kategori;
use App\tb_vendor;
use App\tb_transaksi;
use DB;

class PenerimaanMasterController extends Controller
{
  public function index()
  {
      $tampilBarang = master::with('tb_outlet','tb_merek', 'tb_kategori')
                      ->get();

      $outlet = tb_outlet::all();
      $merk = tb_merek::all();
      $kategori = tb_kategori::all();
      // $tampilBRG = DB
      return view('penerimaan.penerimaan-master', compact('tampilBarang', 'outlet', 'merk', 'kategori'));
  }

  public function home(){
      return view('index2');
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      $outlet = tb_outlet::all();
      $merk = tb_merek::all();
      $kategori = tb_kategori::all();
      return view('tambahbarang', compact('outlet', 'merk', 'kategori'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $validator = Validator::make(Input::all(),  master::Rules(), master::$messages);
      if ($validator->fails())
           {
              return Redirect::back()->withErrors($validator)->withInput();
          }
      else{
        $master = new master();
        $outlet = $request->outlet;
        $kode_pn = $request->kode_pn;
        $nama_barang = $request->nama_barang;
        $kode_master = $outlet . $kode_pn . $nama_barang;

        $master->kode_outlet = $request->outlet;
        $master->kategori = $request->kategori;
        $master->kode_pn = $request->kode_pn;
        $master->nama_barang = $request->nama_barang;
        $master->merek = $request->merk;
        $master->kode_master = $kode_master;
        $master->keterangan = $request->keterangan;
        $master->save();
        return redirect("/penerimaan-master");
      }


  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Request $request)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(Request $request, $kode_master)
  {


  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
   public function update(Request $request)
   {
       $master = master::findOrFail($request->id_master);

       $master->update($request->all());
       return back();
   }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
      $master = master::findOrFail($request->id_master);
      $master->delete();
      return back();
  }
}
