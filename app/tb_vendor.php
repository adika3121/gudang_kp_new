<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_vendor extends Model
{
    protected $table='tb_vendor';
    protected $primaryKey='kode_vendor';
    protected $fillable= ['nama_vendor','alamat','no_telp'];

    public function tb_transaksi(){
      return $this->hasMany('App\tb_transaksi');
    }

}
