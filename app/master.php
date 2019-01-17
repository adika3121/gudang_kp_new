<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class master extends Model
{
    protected $table='tb_master';
    protected $primaryKey='id_master';

    public function tb_outlet(){
      return $this->belongsTo('App\tb_outlet', 'kode_outlet');
    }

    public function tb_merek(){
      return $this->belongsTo('App\tb_merek', 'merek');
    }

    public function tb_kategori(){
      return $this->belongsTo('App\tb_kategori', 'kategori');
    }

    public function tb_stock_keluar(){
      return $this->hasMany('App\tb_stock_keluar');
    }

    public function tb_transaksi(){
      return $this->hasMany('App\tb_transaksi');
    }

    protected $fillable = [
       'kode_master', 'kode_outlet', 'kategori', 'kode_pn', 'merek', 'nama_barang', 'stock_masuk', 'stock_keluar', 'sisa_stock', 'keterangan'
    ];
}
