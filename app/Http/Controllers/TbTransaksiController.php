<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use View;
use DB;
use Gate;
use App\tb_transaksi;
use App\tb_stock_keluar;
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
        if(Gate::allows('isMarketing')||Gate::allows('isPengiriman')){
            return view('error');
        }
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

    $validator = Validator::make(Input::all(),  tb_transaksi::RulesAwal(), tb_transaksi::$messagesAwal);
    if ($validator->passes())
         {
           $nama_outlet = $request->outlet;
           $id_master = $request->id_master;
           $vendor = $request->kode_vendor;
           $kk_master = master::where('id_master', $id_master)
                         ->select('tb_master.kode_master as kode_master')
                         ->first();
           $kode_master = $kk_master->kode_master;
           return view('Transaksi.sn_transaksi', compact('nama_outlet', 'kode_master', 'id_master', 'vendor'));
            // return Redirect::back()->withErrors($validator)->withInput();
        }
    else{
          $nama_outlet = $request->outlet;
          $outlet = tb_outlet::all();
          $nama_barang = master::where('kode_outlet', $nama_outlet)
                          -> select('tb_master.id_master as id_master', 'tb_master.kode_master as kode_master', 'tb_master.nama_barang as nama_barang')
                          -> get();
          $vendor = tb_vendor::all();

          $data = compact('nama_outlet', 'outlet', 'nama_barang', 'vendor');
          return View::make('Transaksi.tambah_transaksi', $data)->withErrors($validator);

    }

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

      $transaksi = [
        "errors" => null
      ];


      $validator = Validator::make(Input::all(),  tb_transaksi::Rules(), tb_transaksi::$messages);
      if ($validator->passes())
           {
             // ////////////////////////////////////////////////
             $nama_outlet = Input::get('nama_outlet');
             $id_master = Input::get('id_master');
             $vendor = Input::get('vendor');
             $k_master = master::where('id_master', $id_master)
                           ->select('tb_master.kode_master as kode_master')
                           ->first();
             $kode_master = Input::get('kode_master');
             //////////////////////////////////////////

             $transaksi = $validator->errors();
             $data = compact('nama_outlet', 'id_master', 'vendor', 'k_master', 'kode_master');
             ///////////////////////////////////////////////////////

             $nama_outlet = $request->nama_outlet;
             $kode_sn = $request->sn;
             $cek_transaksi = tb_transaksi::where([['sn', $kode_sn],['kode_master', $request->kode_master]])
                              ->first();
            $cek_status_transaksi = tb_transaksi::where([['sn', $kode_sn],['status', 1], ['kode_master', $request->kode_master]])
                                ->first();
             $kode_stock_keluar = tb_stock_keluar::where([['outlet', $nama_outlet], ['sn', $kode_sn],['status', 0],['kode_master', $request->kode_master]])
                                ->select('tb_stock_keluar.kode_keluar as kode')
                                ->first();

            // Kalo ada sn di tabel transaksi
            if(!empty($cek_transaksi)){
              //kalo ada sn di tabel transaksi dengan status 1
              if(!empty($cek_status_transaksi)){
                //kalo sn di tabel keluar statusnya 0
                if(!empty($kode_stock_keluar)){



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
                  $transaksi->kode_master = Input::get('kode_master');
                  $transaksi->sn = Input::get('sn');
                  $transaksi->outlet = $nama_outlet;
                  $transaksi->vendor = $vendor;
                  $transaksi->keterangan = Input::get('keterangan');
                  $transaksi->save();
                  /////////////////////////////////////

                  // Rubah Status di tb_stock_keluar
                  $status_keluar = tb_stock_keluar::findOrFail($kode_stock_keluar->kode);
                  $i = 1;
                  $status_keluar->status = $i;
                  $status_keluar->save();
                  ////////////////////////////

                  // input stock masuk ke tb_master
                  $master = master::find($id_master);
                  $input_stock = tb_transaksi::where('kode_master', $kode_master)
                                ->count();
                  $master->stock_masuk = $input_stock;
                  $master->save();
                  $total_stock = master::where('id_master',$id_master)
                                  ->select(DB::raw('tb_master.stock_masuk - tb_master.stock_keluar as total'))
                                  ->first();
                  $master->sisa_stock = $total_stock->total;
                  $master->save();
                  ////////////////////////////////////

                  return view('Transaksi.sukses_transaksi', compact('nama_outlet', 'kode_master',  'id_master', 'vendor'));
                }else{
                  return View::make('Transaksi.sn_transaksi', $data)->withErrors(array('sn' => 'Stock dengan SN ini belum keluar dari gudang1'));
                }
              }
              else{
                return View::make('Transaksi.sn_transaksi', $data)->withErrors(array('sn' => 'Stock dengan SN ini keluar dari gudang2'));
              }
            }else{
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
              $transaksi->kode_master = Input::get('kode_master');
              $transaksi->sn = Input::get('sn');
              $transaksi->outlet = $nama_outlet;
              $transaksi->vendor = $vendor;
              $transaksi->keterangan = Input::get('keterangan');
              $transaksi->save();

              // input stock masuk ke tb_master
              $master = master::find($id_master);
              $input_stock = tb_transaksi::where('kode_master', $kode_master)
                            ->count();
              $master->stock_masuk = $input_stock;
              $master->save();
              $total_stock = master::where('id_master',$id_master)
                              ->select(DB::raw('tb_master.stock_masuk - tb_master.stock_keluar as total'))
                              ->first();
              $master->sisa_stock = $total_stock->total;
              $master->save();
              ////////////////////////////////////

              return view('Transaksi.sukses_transaksi', compact('nama_outlet', 'kode_master',  'id_master', 'vendor'));
            }



             // // hasil oper dari view sebelumnya
             // $nama_outlet = $request->nama_outlet;
             // $id_master = $request->id_master;
             // $vendor = $request->vendor;
             // $k_master = master::where('id_master', $id_master)
             //               ->select('tb_master.kode_master as kode_master')
             //               ->first();
             // $kode_master = $k_master->kode_master;
             //
             // // Simpan ke db
             // $transaksi = new tb_transaksi();
             // $transaksi->kode_master = Input::get('kode_master');
             // $transaksi->sn = Input::get('sn');
             // $transaksi->vendor = $vendor;
             // $transaksi->keterangan = Input::get('keterangan');
             // $transaksi->save();
             //
             // // ///////
             // // $kode_sn = $request->sn;
             // // $kode_stock_keluar = tb_stock_keluar::where([['outlet', $nama_outlet], ['sn', $kode_sn],['status', 0]])
             // //                    ->select('tb_stock_keluar.kode_keluar as kode')
             // //                    ->first();
             // //
             // //  // kalo sn-nya pernah dipake di stock keluar
             // //  if(!empty($kode_stock_keluar)){
             // //    $stock_keluar = tb_stock_keluar::findOrFail($kode_stock_keluar->kode);
             // //    $i = 1;
             // //    $stock_keluar->status = $i ;
             // //    $stock_keluar->save();
             // //  }else{
             // //    return redirect()->back()->withErrors("sn","Stock Keluar sudah ada");
             // //  }
             // // ///////////////////////
             //
             // // input stock masuk ke tb_master
             // $master = master::find($id_master);
             // $input_stock = tb_transaksi::where('kode_master', $kode_master)
             //               ->count();
             // $master->stock_masuk = $input_stock;
             // $master->save();
             // $total_stock = master::where('id_master',$id_master)
             //                 ->select(DB::raw('tb_master.stock_masuk - tb_master.stock_keluar as total'))
             //                 ->first();
             // $master->sisa_stock = $total_stock->total;
             // $master->save();
             // ////////////////////////////////////
             //
             // return view('Transaksi.sukses_transaksi', compact('nama_outlet', 'kode_master',  'id_master', 'vendor'));
          }
      else{

        // ////////////////////////////////////////////////
        $nama_outlet = Input::get('nama_outlet');
        $id_master = Input::get('id_master');
        $vendor = Input::get('vendor');
        $k_master = master::where('id_master', $id_master)
                      ->select('tb_master.kode_master as kode_master')
                      ->first();
        $kode_master = Input::get('kode_master');
        //////////////////////////////////////////

        $transaksi = $validator->errors();
        $data = compact('nama_outlet', 'id_master', 'vendor', 'k_master', 'kode_master');

        // $data['errors'] = $validation->errors();
        return View::make('Transaksi.sn_transaksi', $data)->withErrors($validator);
         // return view('Transaksi.sukses_transaksi', compact('nama_outlet', 'kode_master',  'id_master', 'vendor'))->withErrors($validator)->withInput();
         // return Redirect::back()->withErrors($validator)->withInput();



      }

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
        if(Gate::allows('isMarketing')||Gate::allows('isPengiriman')){
            return view('error');
        }
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
        if(Gate::allows('isMarketing')||Gate::allows('isPengiriman')){
            return view('error');
        }
       $transaksi = tb_transaksi::findOrFail($request->kode_transaksi);
       $transaksi->delete();

       ///////////// Mengupdate nilai di master
       $id_master = master::where('kode_master', $request->kode_master)
                    ->select('tb_master.id_master as id_master')
                    ->first();
          //////// Update nilai stock_masuk
       $master = master::find($id_master->id_master);
       $delete_stock = tb_transaksi::where('kode_master', $request->kode_master)
                     ->count();
       $master->stock_masuk = $delete_stock;
       $master->save();
          //////////////////////////////

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
