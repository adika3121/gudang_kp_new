<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_stock_keluar extends Model
{
    protected $table='tb_stock_keluar';
    protected $primaryKey='kode_keluar';

    public function master(){
      return $this->belongsTo('App\master', 'kode_master');
    }
    protected $fillable = [
      'sn', 'keterangan'
    ];


    public static function RulesAwal(){
         $rules= array(
           'id_master' => 'required'
        );
       return $rules;
    }

    public static $messagesAwal=array(
        'id_master.required' => 'Barang pada outlet ini belum terdaftar. Silahkan daftarkan di master barang'
    );

    public static function Rules(){
         $rules= array(
           'sn' => 'required|exists:tb_transaksi,sn|unique:tb_stock_keluar,sn'
        );
       return $rules;
    }

    public static $messages=array(
        'sn.required'=>'Masukan SN',
        'sn.exists'=>'Masukan SN yang sudah ada pada transaksi',
        'sn.unique'=>'SN ini sudah digunakan'
    );
}
