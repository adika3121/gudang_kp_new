<?php

namespace App\Http\Controllers;

use App\tb_vendor;
use Illuminate\Http\Request;

class TbVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tampilVendor = tb_vendor::all();
        return view('tambah_vendor', compact('tampilVendor'));
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
            'nama_vendor'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required']);

        $vendor = new tb_vendor();
        $vendor -> nama_vendor = $request -> nama_vendor;
        $vendor -> alamat = $request -> alamat;
        $vendor -> no_telp = $request -> no_telp;
        $vendor->save();
        return redirect('/lainnya');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tb_vendor  $tb_vendor
     * @return \Illuminate\Http\Response
     */
    public function show(tb_vendor $tb_vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tb_vendor  $tb_vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_vendor $tb_vendor)
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
        $vendor = tb_vendor::findOrFail($request->kode_vendor);

        $vendor->update($request->all());
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
        $vendor = tb_vendor::findOrFail($request->kode_vendor);
        $vendor->delete();

        return back();
    }
}
