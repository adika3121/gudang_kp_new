<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_outlet;
use App\tb_kategori;
use Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Gate::allows('isAdmin')){
            return redirect ('/lainnya');
        }else if(Gate::allows('isMarketing')){
            return redirect ('/dashboard');
        }else if(Gate::allows('isGudang')){
            return redirect ('/transaksi');
        }else if(Gate::allows('isPengiriman')){
            return redirect ('/stock-keluar');
        }
        // $tb_outlet = tb_outlet::all();
        // $tb_kategori = tb_kategori::all();
        // return view('dashboard.dashboard', compact('tb_outlet','tb_kategori'));
    }
}
