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

    public static function Rules(){
         $rules= array(
           'sn' => 'required|exists:tb_transaksi,sn'
        );
       return $rules;
    }

    public static $messages=array(
        'sn.required'=>'Masukan SN',
        'sn.exists'=>'Masukan SN yang sudah ada pada transaksi'
    );
}
