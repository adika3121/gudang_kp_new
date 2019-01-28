<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_outlet;
use App\tb_kategori;

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
        $tb_outlet = tb_outlet::all();
        $tb_kategori = tb_kategori::all();
        return view('dashboard.dashboard', compact('tb_outlet','tb_kategori'));
    }
}
