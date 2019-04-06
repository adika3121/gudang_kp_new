<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\master;
use App\tb_outlet;
use App\tb_transaksi;
use App\tb_stock_keluar;
use App\tb_merek;
use App\tb_kategori;
use App\tb_vendor;
use DB;
use View;
use Gate;

class MasterController extends Controller
{
    public function index()
    {
        if(Gate::allows('isMarketing')){
            return view('error');
        }

        $tampilBarang = master::with('tb_outlet','tb_merek', 'tb_kategori')
                        ->get();

        $outlet = tb_outlet::all();
        $merk = tb_merek::all();
        $kategori = tb_kategori::all();
        // $tampilBRG = DB
        return view('master', compact('tampilBarang', 'outlet', 'merk', 'kategori'));
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
        // $outlet = tb_outlet::all();
        // $merk = tb_merek::all();
        // $kategori = tb_kategori::all();
        // return view('tambahbarang', compact('outlet', 'merk', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::allows('isMarketing')){
            return view('error');
        }

        $validator = Validator::make(Input::all(),  master::Rules(), master::$messages);
        if ($validator->fails())
             {
                return Redirect::back()->withErrors($validator)->withInput();
            }
        else{

          $outlet = $request->outlet;
          $kode_pn = $request->kode_pn;
          $nama_barang = $request->nama_barang;
          $kode_master = $outlet . $kode_pn . $nama_barang;

          $cek_kode_master = master::where('kode_master', $kode_master)
                            ->first();
          if (!empty($cek_kode_master)) {
            //Data untuk view Master
            $tampilBarang = master::with('tb_outlet','tb_merek', 'tb_kategori')
                            ->get();

            $outlet = tb_outlet::all();
            $merk = tb_merek::all();
            $kategori = tb_kategori::all();
            $data = compact('tampilBarang', 'outlet', 'merk', 'kategori');
            /////////////////////
            return View::make('master',$data)->withErrors(array('kode_master' => 'Barang dengan kode PN ini sudah ada di Outlet ini'));
          }else{
            $master = new master();
            $master->kode_outlet = $request->outlet;
            $master->kategori = $request->kategori;
            $master->kode_pn = $request->kode_pn;
            $master->nama_barang = $request->nama_barang;
            $master->merek = $request->merk;
            $master->kode_master = $kode_master;
            $master->keterangan = $request->keterangan;
            $master->save();
          }

          return redirect("/master");
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
        // Menghapus di tabel transaksi dan stock keluar
        $kode_master = master::where('id_master', $request->id_master)
                      ->select('tb_master.kode_master as kode')
                      ->first();
        DB::table('tb_transaksi')->where('kode_master', $kode_master->kode)->delete();
        DB::table('tb_stock_keluar')->where('kode_master', $kode_master->kode)->delete();
        ////////////////////////

        // Menghapus di tabel master
        $master = master::findOrFail($request->id_master);
        $master->delete();
        //////////////////////////

        return back();
    }
}
