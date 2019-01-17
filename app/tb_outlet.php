<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_outlet extends Model
{
    protected $table='tb_outlet';
    protected $primaryKey='kode_outlet';
    public $incrementing = false;

    public function master(){
      return $this->hasMany('App\master');
    }

    protected $fillable = [
      'nama_outlet', 'alamat', 'no_telp'
    ];
}
