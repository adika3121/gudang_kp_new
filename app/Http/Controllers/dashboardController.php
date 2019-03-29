<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\transaksiExport;
use App\master;
use App\tb_outlet;
use App\tb_merek;
use App\tb_kategori;
use App\tb_vendor;
use App\tb_transaksi;
use App\tb_stock_keluar;
use Gate;
use View;
use Excel;

class dashboardController extends Controller
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
        if(Gate::allows('isAdmin') || Gate::allows('isMarketing')){
            $tb_outlet = tb_outlet::all();
            $tb_kategori = tb_kategori::all();
            return view('dashboard.dashboard', compact('tb_outlet','tb_kategori'));

        }else{
            return view('error');
        }

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
                                'tb_master.kode_master as kode_master',
                                'tb_master.nama_barang as nama_barang',
                                'tb_master.stock_masuk as stock_masuk',
                                'tb_master.stock_keluar as stock_keluar',
                                'tb_master.sisa_stock as sisa_stock')
                      ->get();
      return view('dashboard.dashboard_lihatStockOutlet', compact('lihat_stock', 'nama_outlet'));

     }

     // SELECT tb_master.`nama_barang`, tb_transaksi.`sn`, tb_transaksi.`created_at`FROM tb_transaksi
     //  JOIN tb_master ON tb_transaksi.`kode_master`=tb_master.`kode_master`
     //  WHERE tb_master.`kode_master`= 'BYSBHHAGSHPCI0 ABS'
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
       return view('dashboard.dashboard_keluarTerbaru', compact('lihat_stock', 'nama_outlet'));
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
                                  'tb_master.kode_master as kode_master',
                                  'tb_master.nama_barang as nama_barang',
                                  'tb_master.stock_masuk as stock_masuk',
                                  'tb_master.stock_keluar as stock_keluar',
                                  'tb_master.sisa_stock as sisa_stock')
                        ->get();
        return view('dashboard.dashboard_basedType', compact('nama_kategori', 'lihat_stock'));
     }


     ///////////////////////////////////////////////////////////////////////////////////////////////////////

     public function lihat_detail_stock(Request $request){
       $kode_master = $request->kode_master;
       $nama_dan_outlet_barang = master::where('kode_master', $request->kode_master)
                                  ->join('tb_outlet', 'tb_outlet.kode_outlet', '=', 'tb_master.kode_outlet')
                                  ->select('tb_master.nama_barang as nama_barang',
                                            'tb_outlet.nama_outlet as nama_outlet')
                                  ->first();

       $transaksi = tb_transaksi::where('kode_master', $request->kode_master)
                    ->select('tb_transaksi.kode_transaksi as kode_trans',
                              'tb_transaksi.kode_master as kode_master',
                              'tb_transaksi.sn as sn',
                              'tb_transaksi.created_at as  waktu_masuk',
                              'tb_transaksi.keterangan as catatan')
                    ->get();

      $stock_keluar = tb_stock_keluar::where('kode_master', $request->kode_master)
                      ->select('tb_stock_keluar.kode_keluar as kode_keluar',
                                'tb_stock_keluar.kode_master as kode_master',
                                'tb_stock_keluar.sn as sn',
                                'tb_stock_keluar.created_at as waktu_keluar',
                                'tb_stock_keluar.keterangan as catatan',
                                'tb_stock_keluar.status as status')
                      ->get();
        $sisa_stock = tb_transaksi::where([['kode_master', $request->kode_master],['status', 0]])
                      ->select('tb_transaksi.kode_transaksi as kode_transaksi',
                                'tb_transaksi.kode_master as kode_master',
                                'tb_transaksi.sn as sn',
                                'tb_transaksi.created_at as waktu_masuk',
                                'tb_transaksi.keterangan as catatan')
                      ->get();
        $status_jadi = $this->status_jadi;
       return view('dashboard.dashboard_detStockMasuk', compact('nama_dan_outlet_barang', 'transaksi', 'stock_keluar','sisa_stock','kode_master','status_jadi'));
     }

     public function get_excell_sisa_stock(Request $request){
       // return Excel::download(new transaksiExport, 'transaksi.xlsx');
       $kode_master = $request->kode_master;
       $nama_dan_outlet_barang = master::where('kode_master', $request->kode_master)
                                  ->join('tb_outlet', 'tb_outlet.kode_outlet', '=', 'tb_master.kode_outlet')
                                  ->select('tb_master.nama_barang as nama_barang',
                                            'tb_outlet.nama_outlet as nama_outlet')
                                  ->first();
      $sisa_stock = tb_transaksi::where([['kode_master', $request->kode_master],['status', 0]])
                    ->select('tb_transaksi.kode_transaksi as kode_transaksi',
                              'tb_transaksi.kode_master as kode_master',
                              'tb_transaksi.sn as sn',
                              'tb_transaksi.created_at as waktu_masuk',
                              'tb_transaksi.keterangan as catatan')
                    ->get();

       return Excel::download(new transaksiExport($sisa_stock), "transaksi"."$nama_dan_outlet_barang->nama_barang"."pada"."$nama_dan_outlet_barang->nama_outlet".".xlxs");

      //  $nama_dan_outlet_barang = master::where('kode_master', $request->kode_master)
      //                             ->join('tb_outlet', 'tb_outlet.kode_outlet', '=', 'tb_master.kode_outlet')
      //                             ->select('tb_master.nama_barang as nama_barang',
      //                                       'tb_outlet.nama_outlet as nama_outlet')
      //                             ->first();
      //   $nama_outlet_array[] = array('nama_barang', 'nama_outlet');
      //
      //
      //  $transaksi = tb_transaksi::where('kode_master', $request->kode_master)
      //               ->select('tb_transaksi.kode_transaksi as kode_trans',
      //                         'tb_transaksi.kode_master as kode_master',
      //                         'tb_transaksi.sn as sn',
      //                         'tb_transaksi.created_at as  waktu_masuk',
      //                         'tb_transaksi.keterangan as catatan')
      //               ->get();
      // $transaksi_array[] = array('Kode Master', 'SN', 'Waktu Masuk', 'Catatan');
      // foreach($transaksi as $trx){
      //   $transaksi_array[] = array(
      //                         'Kode Master' => $trx->kode_master,
      //                         'SN' => $trx->sn,
      //                         'Waktu Masuk'=> $trx->waktu_masuk,
      //                         'Catatan' => $trx->catatan
      //                       );
      // }
      // Excel::store('Stock Masuk '.$nama_dan_outlet_barang->nama_barang.' pada '.$nama_dan_outlet_barang->nama_outlet,
      //               function($excel) use($transaksi_array){
      //                 $excel->setTitle('Stock Masuk');
      //                 $excel->sheet('Stock Masuk', function($sheet) use($transaksi_array){
      //                   $sheet->fromArray($transaksi_array, null, A1, false, false);
      //                 });
      //               })->download('xlsx');

      // $stock_keluar = tb_stock_keluar::where('kode_master', $request->kode_master)
      //                 ->select('tb_stock_keluar.kode_keluar as kode_keluar',
      //                           'tb_stock_keluar.kode_master as kode_master',
      //                           'tb_stock_keluar.sn as sn',
      //                           'tb_stock_keluar.created_at as waktu_keluar',
      //                           'tb_stock_keluar.keterangan as catatan')
      //                 ->get();
      //   $sisa_stock = tb_transaksi::where([['kode_master', $request->kode_master],['status', 0]])
      //                 ->select('tb_transaksi.kode_transaksi as kode_transaksi',
      //                           'tb_transaksi.kode_master as kode_master',
      //                           'tb_transaksi.sn as sn',
      //                           'tb_transaksi.created_at as waktu_masuk',
      //                           'tb_transaksi.keterangan as catatan')
      //                 ->get();
     }

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
    public function edit(Request $request)
    {
        $transaksi = tb_transaksi::findOrFail($request->kode_master);
        return view('dashboard.dashboard_detStockMasuk', compact('transaksi'));
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
