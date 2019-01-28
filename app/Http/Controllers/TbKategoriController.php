<?php

namespace App\Http\Controllers;

use App\tb_kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Gate;

class TbKategoriController extends Controller
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
      $validator = Validator::make(Input::all(),  tb_kategori::Rules(), tb_kategori::$messages);
      if ($validator->fails())
           {
              return Redirect::back()->withErrors($validator)->withInput();
          }
      else{
        $kategori = new tb_kategori();
        $kategori -> nama_kategori = $request -> nama_kategori;
        $kategori->save();
        return redirect('/lainnya');
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tb_kategori  $tb_kategori
     * @return \Illuminate\Http\Response
     */
    public function show(tb_kategori $tb_kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tb_kategori  $tb_kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_kategori $tb_kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tb_kategori  $tb_kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make(Input::all(),  tb_kategori::RulesUpdate(), tb_kategori::$messagesUpdate);
        if ($validator->fails())
             {
                return Redirect::back()->withErrors($validator)->withInput();
            }
        else {
          $kategori = tb_kategori::findOrFail($request->kode_kategori_update);
          $kategori->nama_kategori = $request->nama_kategori_update;
          $kategori->save();
          return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tb_kategori  $tb_kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $kategori = tb_kategori::findOrFail($request->kode_kategori);
        $kategori->delete();

        return back();
    }
}
