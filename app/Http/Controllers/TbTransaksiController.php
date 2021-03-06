<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use View;
use DB;
use Gate;
use Illuminate\Validation\Rule;
use App\tb_transaksi;
use App\tb_vendor;
use App\tb_stock_keluar;
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
   public $status_jadi =  [
          0 => 'Tersedia',
          1 => 'Sudah Keluar'
        ];
  public function index()
  {
        if(Gate::allows('isMarketing')||Gate::allows('isPengiriman')){
            return view('error');
        }
        $tampilTransaksi = tb_transaksi::with('tb_vendor', 'master')
                        ->get();
        $tb_outlet = tb_outlet::all();
        $vendor=tb_vendor::all();
        $status_jadi = $this->status_jadi;
        // $tampilBRG = DB
        return view('Transaksi.tampil_transaksi', compact('tampilTransaksi', 'tb_outlet', 'vendor', 'status_jadi'));
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
    //pindah ke tampilan masukin barang dan vendor
    return view('Transaksi.tambah_transaksi', compact('nama_outlet', 'outlet', 'nama_barang', 'vendor'));
  }

  public function tambah_transaksi_sn(Request $request){

    $validator = Validator::make(Input::all(),  tb_transaksi::RulesAwal(), tb_transaksi::$messagesAwal);
    if ($validator->passes())
         {
           $nama_outlet = $request->outlet;
           $id_master = $request->id_master;
           $vendor = $request->kode_vendor;
           $keterangan = $request->keterangan;
           $kk_master = master::where('id_master', $id_master)
                         ->select('tb_master.kode_master as kode_master')
                         ->first();
           $kode_master = $kk_master->kode_master;

           //Nama Komponen
           $nama_vendor = tb_vendor::where('kode_vendor', $vendor)
                          ->select('tb_vendor.nama_vendor as nama')
                          ->first();
           $nama_lainnya = master::where('kode_master', $kode_master)
                          ->join('tb_outlet', 'tb_outlet.kode_outlet', '=', 'tb_master.kode_outlet')
                          ->select('tb_master.nama_barang as nama_barang',
                                    'tb_outlet.nama_outlet as nama_outlet')
                          ->first();

           /////// pindah ke tampilan untuk masukin SN
           return view('Transaksi.sn_transaksi', compact('nama_outlet', 'kode_master','nama_vendor','nama_lainnya', 'id_master', 'vendor', 'keterangan'));

        }
    else{
      /// Data yang akan dioper
          $nama_outlet = $request->outlet;
          $outlet = tb_outlet::all();
          $nama_barang = master::where('kode_outlet', $nama_outlet)
                          -> select('tb_master.id_master as id_master', 'tb_master.kode_master as kode_master', 'tb_master.nama_barang as nama_barang')
                          -> get();
          $vendor = tb_vendor::all();
          $keterangan = $request->keterangan;

          $data = compact('nama_outlet', 'outlet', 'nama_barang', 'vendor','keterangan');
          ///////////////////////////////////////////

          /// mengembalikan error dengan validator
          return View::make('Transaksi.tambah_transaksi', $data)->withErrors($validator);

    }

  }

  public function create(Request $request)
  {
    return view('penerimaan.tambahtransaksi');
  }

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
             // /////////////menangkap data dari view
             $nama_outlet = Input::get('nama_outlet');
             $id_master = Input::get('id_master');
             $vendor = Input::get('vendor');
             $k_master = master::where('id_master', $id_master)
                           ->select('tb_master.kode_master as kode_master')
                           ->first();
             $kode_master = Input::get('kode_master');
             $ket = Input::get('keterangan');


             //////////////////////////////////////////

             //Nama Komponen
             $nama_vendor = tb_vendor::where('kode_vendor', $vendor)
                            ->select('tb_vendor.nama_vendor as nama')
                            ->first();
             $nama_lainnya = master::where('kode_master', $kode_master)
                            ->join('tb_outlet', 'tb_outlet.kode_outlet', '=', 'tb_master.kode_outlet')
                            ->select('tb_master.nama_barang as nama_barang',
                                      'tb_outlet.nama_outlet as nama_outlet')
                            ->first();

             /////////////////////////////////////////////

             $transaksi = $validator->errors();

             //mengatur pada saat field keterangan tidak diisi
             if (!empty($ket)) {
               $data = compact('nama_outlet', 'id_master', 'vendor', 'nama_vendor', 'nama_lainnya', 'kode_master', 'ket');
             }else{
               $data = compact('nama_outlet', 'id_master', 'vendor', 'nama_vendor', 'nama_lainnya', 'kode_master');
             }
             ///////////////////////////////////////////////////////

             /// variabel yg dipake untuk validasi
             $nama_outlet = $request->nama_outlet;
             $kode_sn = $request->sn;

             //pilih mau pake yg mana
             $cek_transaksi = tb_transaksi::where('sn', $kode_sn)
                              ->first();// gaboleh ada sn yg sama persis sama sekali di tabel

             // $cek_transaksi = tb_transaksi::where([['sn', $kode_sn],['kode_master', $request->kode_master])
             //                  ->first(); // boleh ada dengan syarat kode_masternya beda

            $cek_status_transaksi = tb_transaksi::where([['sn', $kode_sn],['status', 1]])
                                ->first();
             $kode_stock_keluar = tb_stock_keluar::where([['sn', $kode_sn],['status', 0]])
                                ->select('tb_stock_keluar.kode_keluar as kode')
                                ->first();
            /////////////////////////////////////////
            // Kalo ada sn dan kode master di tabel transaksi
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
                  /////////////////////////////////////////

                  // Simpan ke db
                  $transaksi = new tb_transaksi();
                  $transaksi->kode_master = Input::get('kode_master');
                  $transaksi->sn = Input::get('sn');
                  $transaksi->outlet = $nama_outlet;
                  $transaksi->vendor = $vendor;
                  $transaksi->keterangan = Input::get('keterangan');
                  $transaksi->save();
                  /////////////////////////////////////

                  // input stock masuk ke tb_master
                  $master = master::find($id_master);
                  $input_stock = tb_transaksi::where([['kode_master', $kode_master],['status', 0]])
                                ->count();
                  $master->stock_masuk = $input_stock;
                  $master->save();
                  // Rubah Status di tb_stock_keluar
                  $status_keluar = tb_stock_keluar::findOrFail($kode_stock_keluar->kode);
                  $i = 1;
                  $status_keluar->status = $i;
                  $status_keluar->save();
                  // Menghitung jumlah stock keluar untuk dimasukan ke tb_master
                  $master = master::find($id_master);
                  $out_stock = tb_stock_keluar::where([['kode_master', $kode_master],['status', 0]])
                                ->count();
                  $master->stock_keluar = $out_stock;
                  $master->save();
                  // input ke total stock
                  $total_stock = master::where('id_master',$id_master)
                                  ->select(DB::raw('tb_master.stock_masuk - tb_master.stock_keluar as total'))
                                  ->first();
                  $master->sisa_stock = $total_stock->total;
                  $master->save();
                  ////////////////////////////////////

                  // // Rubah Status di tb_stock_keluar
                  // $status_keluar = tb_stock_keluar::findOrFail($kode_stock_keluar->kode);
                  // $i = 1;
                  // $status_keluar->status = $i;
                  // $status_keluar->save();
                  // ////////////////////////////

                  //Balik lagi ke view masukin sn dengan alert barang berhasil masuk
                  return View::make('Transaksi.sn_transaksi', $data)->withErrors(array('success'=> 'Barang Berhasil ditambahkan'));
                }else{
                  //Balik lagi ke view masukin sn dengan alert barang tidak masuk
                  return View::make('Transaksi.sn_transaksi', $data)->withErrors(array('sn' => 'Stock dengan SN ini belum keluar dari gudang'));
                }
                ///////Batas cek status keluar

              }
              else{
                //Balik lagi ke view masukin sn dengan alert barang tidak masuk
                return View::make('Transaksi.sn_transaksi', $data)->withErrors(array('sn' => 'Stock dengan SN ini belum keluar dari gudang'));
              }
              ////////Batas cek status transaksi

            }else{
              // hasil oper dari view sebelumnya
              $nama_outlet = $request->nama_outlet;
              $id_master = $request->id_master;
              $vendor = $request->vendor;
              $k_master = master::where('id_master', $id_master)
                            ->select('tb_master.kode_master as kode_master')
                            ->first();
              $kode_master = $k_master->kode_master;
              ///////////////////////////////////////////////////////////////

              // Simpan ke db
              $transaksi = new tb_transaksi();
              $transaksi->kode_master = Input::get('kode_master');
              $transaksi->sn = Input::get('sn');
              $transaksi->outlet = $nama_outlet;
              $transaksi->vendor = $vendor;
              $transaksi->keterangan = Input::get('keterangan');
              $transaksi->save();
              /////////////////////////////////////////////////////

              // input stock masuk ke tb_master
              $master = master::find($id_master);
              $input_stock = tb_transaksi::where([['kode_master', $kode_master],['status', 0]])
                            ->count();
              $master->stock_masuk = $input_stock;
              $master->save();
              // input ke total stock
              $total_stock = master::where('id_master',$id_master)
                              ->select(DB::raw('tb_master.stock_masuk - tb_master.stock_keluar as total'))
                              ->first();
              $master->sisa_stock = $total_stock->total;
              $master->save();
              ////////////////////////////////////

              //////Balik lagi ke view masukin sn dengan alert barang berhasil masuk
              return View::make('Transaksi.sn_transaksi', $data)->withErrors(array('success'=> 'Barang Berhasil ditambahkan'));
            }
            ////////Batas cek ada di tabel transaksi atau tidak


      //Kalau validator tidak berhasil
      }else{

        // ////////////////////////////////////////////////
        $nama_outlet = Input::get('nama_outlet');
        $id_master = Input::get('id_master');
        $vendor = Input::get('vendor');
        $k_master = master::where('id_master', $id_master)
                      ->select('tb_master.kode_master as kode_master')
                      ->first();
        $kode_master = Input::get('kode_master');
        $ket = Input::get('keterangan');
        //////////////////////////////////////////
        //Nama Komponen
        $nama_vendor = tb_vendor::where('kode_vendor', $vendor)
                       ->select('tb_vendor.nama_vendor as nama')
                       ->first();
        $nama_lainnya = master::where('kode_master', $kode_master)
                       ->join('tb_outlet', 'tb_outlet.kode_outlet', '=', 'tb_master.kode_outlet')
                       ->select('tb_master.nama_barang as nama_barang',
                                 'tb_outlet.nama_outlet as nama_outlet')
                       ->first();
        ///////////////////////////////////////////
        //mengatur pada saat field keterangan tidak diisi
        $transaksi = $validator->errors();
        if (!empty($ket)) {
          $data = compact('nama_outlet', 'id_master', 'vendor', 'nama_vendor', 'nama_lainnya', 'kode_master', 'ket');
        }else{
          $data = compact('nama_outlet', 'id_master', 'vendor', 'nama_vendor', 'nama_lainnya', 'kode_master');
        }
        ////////

        /// Balik ke view tambah sn dengan error
        return View::make('Transaksi.sn_transaksi', $data)->withErrors($validator);
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
        $tb_transaksi= tb_transaksi::all();
        $rules= array(
          'sn' => 'required|max:30'
        );


        $messagesUpdate= array(
          'sn.required'=>'Masukan SN',
          'sn.max' => 'Kode SN terlalu panjang. Maksimal 30 Karakter',
          'sn.unique' => 'Kode SN sudah ada'
        );

       $validator = Validator::make($request->all(),
                                    $rules,
                                    $messagesUpdate);
       if ($validator->fails()) {
         return Redirect::back()->withErrors($validator)->withInput();
       }else{
         $kode_sn = $request->sn;
         $kode_transaksi = $request->kode_transaksi;
         $cek_sn_satu_tabel = tb_transaksi::where('sn', $kode_sn)
                              ->first();
         $cek_sn_sebelumnya = tb_transaksi::where([['sn', $kode_sn],['kode_transaksi', $kode_transaksi]])
                              ->first();
         $tran = tb_transaksi::findOrFail($request->kode_transaksi);
         $kode_stock_keluar = tb_stock_keluar::where([['sn', $kode_sn],['status', 0],['kode_master', $request->kode_master]])
                           ->select('tb_stock_keluar.kode_keluar as kode')
                           ->first();
        // Validasi
        // Kalo sn-nya udah ada di tabel ini
        if (!empty($cek_sn_satu_tabel)) {
          //kalo sn-nya gaa diganti
          if (!empty($cek_sn_sebelumnya)) {
            $transaksi = tb_transaksi::findOrFail($request->kode_transaksi);

            $transaksi->vendor = $request->vendor;
            $transaksi->keterangan = $request->keterangan;
            $transaksi->sn = $request->sn;
            $transaksi->save();
            return back();
          //kalo sn-nya udah ada di stock keluar dan statusnya 0
          }elseif(!empty($kode_stock_keluar)){
            $transaksi = tb_transaksi::findOrFail($request->kode_transaksi);

            $transaksi->vendor = $request->vendor;
            $transaksi->keterangan = $request->keterangan;
            $transaksi->sn = $request->sn;
            $transaksi->save();

            //rubah status di stok Keluar
            $status_keluar = tb_stock_keluar::findOrFail($kode_stock_keluar->kode);
            $i=1;
            $status_keluar->status=$i;
            $status_keluar->save();
            return back();
          }else {
            //Data view sebelumnya
            $tampilTransaksi = tb_transaksi::with('tb_vendor', 'master')
                            ->get();
            $tb_outlet = tb_outlet::all();
            $vendor=tb_vendor::all();
            /////////////////////

            $data = compact('tampilTransaksi','tb_outlet','vendor');
            return redirect('/transaksi')->withErrors(array('sn' => 'Stock dengan SN ini sudah ada'))->withInput();
          }
          //kalo sn-nya udah ada di stock keluar dan statusnya 0
        }elseif(!empty($kode_stock_keluar)){
          $transaksi = tb_transaksi::findOrFail($request->kode_transaksi);

          $transaksi->vendor = $request->vendor;
          $transaksi->keterangan = $request->keterangan;
          $transaksi->sn = $request->sn;
          $transaksi->save();

          $status_keluar = tb_stock_keluar::findOrFail($kode_stock_keluar->kode);
          $i=1;
          $status_keluar->status=$i;
          $status_keluar->save();
          return back();
        }else {
          $transaksi = tb_transaksi::findOrFail($request->kode_transaksi);

          $transaksi->vendor = $request->vendor;
          $transaksi->keterangan = $request->keterangan;
          $transaksi->sn = $request->sn;
          $transaksi->save();
        }


       }

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
       $delete_stock = tb_transaksi::where([['kode_master', $request->kode_master],['status', 0]])
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
