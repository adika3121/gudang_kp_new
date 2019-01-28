<?php

namespace App\Http\Controllers;

use App\tb_vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Gate;

class TbVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if(!Gate::allows('isAdmin')){
            return view('error');
        }
        return redirect('/lainnya');
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
      $validator = Validator::make(Input::all(),  tb_vendor::Rules(), tb_vendor::$messages);
      if ($validator->fails())
           {
              return Redirect::back()->withErrors($validator)->withInput();
          }
      else {
        $vendor = new tb_vendor();
        $vendor -> nama_vendor = $request -> nama_vendor;
        $vendor -> alamat = $request -> alamat;
        $vendor -> no_telp = $request -> no_telp;
        $vendor->save();
        return redirect('/lainnya');
      }
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
        $validator = Validator::make(Input::all(),  tb_vendor::RulesUpdate(), tb_vendor::$messagesUpdate);
        if ($validator->fails())
             {
                return Redirect::back()->withErrors($validator)->withInput();
            }
        else {
            $vendor = tb_vendor::findOrFail($request->kode_vendor);
            $vendor -> nama_vendor = $request -> nama_vendor_update;
            $vendor -> alamat = $request -> alamat_update;
            $vendor -> no_telp = $request -> no_telp_update;
            $vendor->save();
            return back();
        }

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
