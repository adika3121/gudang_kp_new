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
}
