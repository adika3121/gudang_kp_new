<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use View;
use DB;
use Gate;
use App\tb_stock_keluar;
use App\tb_outlet;
use App\master;
use App\tb_transaksi;

class TbStockKeluarController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public $status_jadi =  [
          0 => 'Sudah Keluar',
          1 => 'Batal'
        ];

  public function index()
  {
    if(Gate::allows('isMarketing')||Gate::allows('isGudang')){
      return view('error');
    }
    $stock_keluar = tb_stock_keluar::all();
    $tb_outlet = tb_outlet::all();
    $status_jadi = $this->status_jadi;
    return view('stock_keluar.tampil_stockKeluar', compact('stock_keluar', 'tb_outlet', 'status_jadi'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function tambah_stock_keluar(Request $request){
     return view('stock_keluar.tambah_sn');
   }

   public function tambah_sn_keluar(Request $request){

   }

  public function create(Request $request)
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function store_sn(Request $request){
    $stock_out = [
      "errors" => null
    ];
    $validator = Validator::make(Input::all(),  tb_stock_keluar::Rules(), tb_stock_keluar::$messages);
    if($validator->passes()){
      $ket = Input::get('keterangan');
      $sn = Input::get('sn');

      // Mencari Data SN dari Tabel Transaksi
      $cari_sn = tb_transaksi::where([['sn', $sn],['status', 0]])
                  ->join('tb_outlet', 'tb_outlet.kode_outlet', '=', 'tb_transaksi.outlet')
                  ->select('tb_outlet.nama_outlet as nama_outlet',
                            'tb_outlet.kode_outlet as kode_outlet',
                            'tb_transaksi.kode_master as kode_master')
                  ->first();
      //////////////////////////////////////////////

      //// Validator Cari SN
      if(!empty($cari_sn)){
        //Nama Komponen
        $nama_lainnya = master::where('kode_master', $cari_sn->kode_master)
                       ->join('tb_outlet', 'tb_outlet.kode_outlet', '=', 'tb_master.kode_outlet')
                       ->select('tb_master.nama_barang as nama_barang',
                                 'tb_outlet.kode_outlet as kode_outlet')
                       ->first();
        ///////////////////////////////////////////

        /// Cek Keterangan
        if (!empty($ket)) {
          $data = compact('nama_lainnya', 'cari_sn', 'ket');
        }else {
          $data = compact('nama_lainnya', 'cari_sn');
        }
        /////////////////////////////

        /// Mencari ID Master
        $i_master = master::where('kode_master', $cari_sn->kode_master)
                    ->select('tb_master.id_master as id_master')
                    ->first();
        $id_master = $i_master->id_master;

        ///////////////

        ///////// Variabel Validasi Untuk Masuk ke tabel
        $cek_keluar = tb_stock_keluar::where([['sn', $sn], ['kode_master', $cari_sn->kode_master]])
                              ->first();
        $cek_status_keluar = tb_stock_keluar::where([['sn', $sn], ['kode_master', $cari_sn->kode_master], ['status',1]])
                              ->first();
        $cek_transaksi = tb_transaksi::where([['sn', $sn], ['kode_master', $cari_sn->kode_master],['status', 0]])
                        ->select('tb_transaksi.kode_transaksi as kode')
                        ->first();
        ///////////////////////////////////////////////////////

        ///////// Validasi If Mulai
        //Kalau sn sudah ada di tabel transaksi
        if(!empty($cek_transaksi)){
          // Kalau sn sudah pernah masuk ke tabel keluar
          if(!empty($cek_keluar)){
            // kalau barang yg sudah pernah masuk itu statusnya 1 (artinya sudah dapet masuk lagi)
            if(!empty($cek_status_keluar)){
              ///// Data untuk tabel
              $k_outlet = $cari_sn->kode_outlet;
              $kode_master = $cari_sn->kode_master;
              //////////////////////////////////////

              ///// Simpan ke DB
              $stock_out = new tb_stock_keluar();
              $stock_out->sn = Input::get('sn');
              $stock_out->kode_master = $kode_master;
              $stock_out->keterangan = Input::get('keterangan');
              $stock_out->outlet = $k_outlet;
              $stock_out->save();
              /////////////////////

              // Rubah Status di tabel Transaksi
              $status_transaksi = tb_transaksi::findOrFail($cek_transaksi->kode);
              $i = 1;
              $status_transaksi->status = $i;
              $status_transaksi->save();
              /////////////

              ///// Menghitung jumlah stock keluar untuk dimasukan ke tb_master
              $master = master::find($id_master);
              $out_stock = tb_stock_keluar::where([['kode_master', $kode_master],['status', 0]])
                            ->count();
              $master->stock_keluar = $out_stock;
              $master->save();
              $total_stock = master::where('id_master',$id_master)
                              ->select(DB::raw('tb_master.stock_masuk - tb_master.stock_keluar as total'))
                              ->first();
              $master->sisa_stock = $total_stock->total;
              $master->save();
              //////////////////////////////////////


              return View::make('stock_keluar.tambah_sn', $data)->withErrors(array('success'=> 'Barang Berhasil dikeluarkan'));
              // return view('stock_keluar.sukses_stockKeluar', compact('nama_outlet', 'kode_master', 'ket', 'id_master', 'stock_out'));
            }else{
              return View::make('stock_keluar.tambah_sn', $data)->withErrors(array('sn' => 'Stock dengan SN ini belum masuk ke transaksi'));
            }
          }else{
            ///// Data untuk tabel
            $k_outlet = $cari_sn->kode_outlet;
            $kode_master = $cari_sn->kode_master;
            //////////////////////////////////////

            ///// Simpan ke DB
            $stock_out = new tb_stock_keluar();
            $stock_out->sn = Input::get('sn');
            $stock_out->kode_master = $kode_master;
            $stock_out->keterangan = Input::get('keterangan');
            $stock_out->outlet = $k_outlet;
            $stock_out->save();
            /////////////////////

            // Rubah Status di tabel Transaksi
            $status_transaksi = tb_transaksi::findOrFail($cek_transaksi->kode);
            $i = 1;
            $status_transaksi->status = $i;
            $status_transaksi->save();
            /////////////

            ///// Menghitung jumlah stock keluar untuk dimasukan ke tb_master
            $master = master::find($id_master);
            $out_stock = tb_stock_keluar::where([['kode_master', $kode_master],['status',0]])
                          ->count();
            $master->stock_keluar = $out_stock;
            $master->save();
            $total_stock = master::where('id_master',$id_master)
                            ->select(DB::raw('tb_master.stock_masuk - tb_master.stock_keluar as total'))
                            ->first();
            $master->sisa_stock = $total_stock->total;
            $master->save();
            //////////////////////////////////////


            return View::make('stock_keluar.tambah_sn', $data)->withErrors(array('success'=> 'Barang Berhasil dikeluarkan'));
          }
        }else {
          return View::make('stock_keluar.tambah_sn', $data)->withErrors(array('sn' => 'Stock dengan SN ini belum masuk ke transaksi'));
        }

        /////////////// Validasi If Selesai
      }else{
        /// Kalo SN Tidak ketemu
        /// Cek Keterangan
        $data = compact('ket');
        /////////////////////////////

        return View::make('stock_keluar.tambah_sn', $data)->withErrors(array('sn' => 'Stock dengan SN ini belum masuk ke transaksi'));
        ////////////////////
      }

      /////////////////

    }

  }

  //fungsi ini tidak dipakai
  public function store(Request $request)
  {

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
    if(Gate::allows('isMarketing')||Gate::allows('isGudang')){
      return view('error');
    }

    $rules= array(
      'sn' => 'required|max:30'
    );


    $messagesUpdate= array(
      'sn.required'=>'Masukan SN',
      'sn.max' => 'Kode SN terlalu panjang. Maksimal 30 Karakter',
      'sn.unique' => 'Kode SN sudah ada'
    );

   $validator = Validator::make(Input::all(),
                                $rules,
                                $messagesUpdate);
    if($validator->fails()){
      return Redirect::back()->withErrors($validator)->withInput();
    }else{
      $kode_sn = $request->sn;
      $kode_keluar = $request->kode_keluar;
      $cek_sn_satu_tabel = tb_stock_keluar::where('sn', $kode_sn)
                           ->first();
      $cek_sn_sebelumnya = tb_stock_keluar::where([['sn', $kode_sn],['kode_keluar', $kode_keluar]])
                           ->first();
      $stk_k = tb_stock_keluar::findOrFail($request->kode_keluar);
       $cek_transaksi = tb_transaksi::where([['sn', $kode_sn], ['kode_master', $stk_k->kode_master],['status', 0]])
                      ->join('tb_outlet', 'tb_outlet.kode_outlet', '=', 'tb_transaksi.outlet')
                       ->select('tb_transaksi.kode_transaksi as kode',
                                'tb_outlet.nama_outlet as nama_outlet',
                                'tb_outlet.kode_outlet as kode_outlet',
                                 'tb_transaksi.kode_master as kode_master')
                       ->first();

      //ada sn yg sama di satu tabel
       if (!empty($cek_sn_satu_tabel)) {
         // Tidak edit sn ini
         if (!empty($cek_sn_sebelumnya)) {
           $stock_keluar = tb_stock_keluar::findOrFail($request->kode_keluar);

           $stock_keluar->sn = $request->sn;
           $stock_keluar->keterangan = $request->keterangan;
           $stock_keluar->save();
           return back();
           // Cek di tb_transaksi sn yg sama ini statusnya 0 apa tidak
         }elseif(!empty($cek_transaksi)) {
           $stock_keluar = tb_stock_keluar::findOrFail($request->kode_keluar);
           $stock_keluar->sn = $request->sn;
           $stock_keluar->keterangan = $request->keterangan;
           $stock_keluar->save();

           // Rubah Status di tb_transaksi
           $status_transaksi = tb_transaksi::findOrFail($cek_transaksi->kode);
           $i = 1;
           $status_transaksi->status = $i;
           $status_transaksi->save();
           ////////////////////////////
           return back();
         }else{
           return redirect('/stock-keluar')->withErrors(array('sn' => 'Stock dengan SN belum masuk di transaksi'))->withInput();
         }
      // Cek apakah sn ini statusnya di transaksi 0 apa tidak
       }elseif(!empty($cek_transaksi)) {
         $stock_keluar = tb_stock_keluar::findOrFail($request->kode_keluar);

         $stock_keluar->sn = $request->sn;
         $stock_keluar->keterangan = $request->keterangan;
         $stock_keluar->save();

         // Rubah Status di tb_transaksi
         $status_transaksi = tb_transaksi::findOrFail($cek_transaksi->kode);
         $i = 1;
         $status_transaksi->status = $i;
         $status_transaksi->save();
         ////////////////////////////
         return back();


       }else{
         return redirect('/stock-keluar')->withErrors(array('sn' => 'Stock dengan SN ini belum masuk di transaksi'))->withInput();
       }

    }//end validator

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\tb_vendor  $tb_vendor
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
      if(Gate::allows('isMarketing')||Gate::allows('isGudang')){
        return view('error');
      }

      $stock_keluar = tb_stock_keluar::findOrFail($request->kode_keluar);
      $status = 1;
      $stock_keluar->status = $status;
      $stock_keluar->save();

      ///////////// ngambil id master
      $id_master = master::where('kode_master', $request->kode_master)
                   ->select('tb_master.id_master as id_master')
                   ->first();

        ////////// Update nilai stock keluar
      $master = master::find($id_master->id_master);
      $delete_stock = tb_stock_keluar::where([['kode_master', $request->kode_master],['status', 0]])
                    ->count();
      $master->stock_keluar = $delete_stock;
      $master->save();
        ////////////////////////////////////

      //////// Rubah status di stock Masuk
      $s_masuk = tb_transaksi::where([['kode_master', $request->kode_master],['sn', $request->sn],['status', 1]])
                  ->first();
      $status = 0;
      $s_masuk->status=$status;
      $s_masuk->save();
      //////////////////////////////////

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
