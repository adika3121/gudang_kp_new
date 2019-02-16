<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_transaksi extends Model
{
    protected $table='tb_transaksi';
    protected $primaryKey='kode_transaksi';

    public function master(){
      return $this->belongsTo('App\master', 'kode_master');
    }

    public function tb_vendor(){
      return $this->belongsTo('App\tb_vendor', 'vendor');
    }

    public function tb_outlet(){
      return $this->belongsTo('App\tb_outlet', 'outlet');
    }

    protected $fillable = [
       'kode_transaksi', 'kode_master', 'sn', 'vendor', 'tgl_masuk', 'keterangan'
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
           'sn.*' => 'required|max:30'
        );
       return $rules;
    }

    public static $messages=array(
        'sn.*.required'=>'Masukan SN',
        'sn.*.max' => 'Kode SN terlalu panjang. Maksimal 30 Karakter'
    );

}
