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

    public static function Rules(){
         $rules= array(
           'nama_kategori' => 'required'
        );
       return $rules;
    }

    public static function RulesUpdate(){
         $rules= array(
           'nama_kategori_update' => 'required'
        );
       return $rules;
    }

    public static $messages=array(
        'nama_kategori.required'=>'Field Nama Kategori Wajib Diisi'
    );

    public static $messagesUpdate=array(
        'nama_kategori_update.required'=>'Field Nama Kategori Wajib Diisi'
    );
}
