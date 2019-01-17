<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_outlet;

class TbOutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tampilOutlet = tb_outlet::all();
        return view('tambah_outlet', compact('tampilOutlet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $this->validate($request,[
        	'kode_outlet'=>'required',
            'nama_outlet'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required']);

        $outlet = new tb_outlet();
        $outlet -> kode_outlet = $request -> kode_outlet;
        $outlet -> nama_outlet = $request -> nama_outlet;
        $outlet -> alamat = $request -> alamat;
        $outlet -> no_telp = $request -> no_telp;
        $outlet->save();
        return redirect('/lainnya');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tb_vendor  $tb_vendor
     * @return \Illuminate\Http\Response
     */
    public function show(tb_outlet $tb_outlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tb_vendor  $tb_vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_outlet $tb_outlet)
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
        $outlet = tb_outlet::findOrFail($request->kode_outlet);

        $outlet->update($request->all());
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
        $outlet = tb_outlet::findOrFail($request->kode_outlet);
        $outlet->delete();

        return back();
    }
}
