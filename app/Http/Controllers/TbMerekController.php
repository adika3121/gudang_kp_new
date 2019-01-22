<?php

namespace App\Http\Controllers;

use App\tb_merek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class TbMerekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tampilMerk = tb_merek::all();
        return view('tambah_merk', compact('tampilMerk'));
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
      $validator = Validator::make(Input::all(),  tb_merek::Rules(), tb_merek::$messages);
      if ($validator->fails())
           {
              return Redirect::back()->withErrors($validator)->withInput();
          }
        else {
          $merk = new tb_merek();
          $merk -> nama_merek = $request -> nama_merek;
          $merk->save();
          return redirect('/lainnya');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tb_merek  $tb_merek
     * @return \Illuminate\Http\Response
     */
    public function show(tb_merek $tb_merek)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tb_merek  $tb_merek
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_merek $tb_merek)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tb_merek  $tb_merek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make(Input::all(),  tb_merek::RulesUpdate(), tb_merek::$messagesUpdate);
        if ($validator->fails())
             {
                return Redirect::back()->withErrors($validator)->withInput();
            }
        else {
            $merk = tb_merek::findOrFail($request->kode_merek_update);
            $merk -> nama_merek = $request -> nama_merek_update;
            $merk->save();
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tb_merek  $tb_merek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $merk = tb_merek::findOrFail($request->kode_merek);
        $merk->delete();

        return back();
    }
}
