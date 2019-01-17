<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_kategori extends Model
{
    protected $table='tb_kategori';
    protected $primaryKey='kode_kategori';

    public function master(){
      return $this->hasMany('App\master');
    }

    protected $fillable = ['nama_kategori'];
}
