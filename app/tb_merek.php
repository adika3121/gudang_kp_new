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

    public static function Rules(){
         $rules= array(
           'nama_merek' => 'required|unique:tb_merek,nama_merek'
        );
       return $rules;
    }

    public static $messages=array(
        'nama_merek.required'=>'Field Nama Merk Wajib Diisi',
        'nama_merek.unique'=>'Merk ini sudah ada'
    );

    public static function RulesUpdate(){
         $rules= array(
           'nama_merek_update' => 'required|unique:tb_merek,nama_merek'
        );
       return $rules;
    }

    public static $messagesUpdate=array(
        'nama_merek_update.required'=>'Field Nama Merk Wajib Diisi',
        'nama_merek_update.unique'=>'Merk ini sudah ada'
    );
}
