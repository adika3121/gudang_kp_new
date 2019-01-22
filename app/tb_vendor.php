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

    public static function Rules(){
         $rules= array(
           'nama_vendor' => 'required',
           'alamat' => 'required',
           'no_telp' => 'required|max:12'
        );
       return $rules;
    }

    public static $messages=array(
        'nama_vendor.required'=>'Field Nama Vendor Wajib Diisi',
        'alamat.required'=>'Field Alamat Wajib Diisi',
        'no_telp.required'=> 'Field No Telp wajib diisi',
        'no_telp.max' => 'No Telp hanya boleh maksimal 12 karakter'
    );

    public static function RulesUpdate(){
         $rules= array(
           'nama_vendor_update' => 'required',
           'alamat_update' => 'required',
           'no_telp_update' => 'required|max:12'
        );
       return $rules;
    }

    public static $messagesUpdate=array(
        'nama_vendor_update.required'=>'Field Nama Vendor Wajib Diisi',
        'alamat_update.required'=>'Field Alamat Wajib Diisi',
        'no_telp_update.required'=> 'Field No Telp wajib diisi',
        'no_telp_update.max' => 'No Telp hanya boleh maksimal 12 karakter'
    );

}
