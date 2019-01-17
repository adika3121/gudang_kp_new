<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_merek extends Model
{
    protected $table='tb_merek';
    protected $primaryKey='kode_merek';

    public function master(){
      return $this->hasMany('App\master');
    }

    protected $fillable = ['nama_merek'];
}
