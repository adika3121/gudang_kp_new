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

    protected $fillable = [
       'kode_transaksi', 'kode_master', 'sn', 'vendor', 'tgl_masuk', 'keterangan'
    ];

    public static function Rules(){
         $rules= array(
           'keterangan' => 'required',
           'sn' => 'required'
        );
       return $rules;
    }

    public static $messages=array(
        'kode_pn.required'=>'Masukan Kode PN ',
        'nama_barang.required'=>'Masukan Nama Barang'
    );

}
