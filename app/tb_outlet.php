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
      'kode_outlet','nama_outlet', 'alamat', 'no_telp'
    ];

    public static function Rules(){
         $rules= array(
           'kode_outlet' => 'required|max:7|unique:tb_outlet,kode_outlet',
           'nama_outlet' => 'required|unique:tb_outlet,nama_outlet',
           'alamat_outlet' => 'required',
           'no_telp_outlet' => 'required|max:12'
        );
       return $rules;
    }

    public static $messages=array(
        'kode_outlet.required' => 'Field Kode Outlet Harus Diisi',
        'kode_outlet.max' => 'Kode Outlet hanya boleh maksimal 7 karakter',
        'kode_outlet.unique' => 'Kode Outlet harus kode yang belum pernah digunakan sebelumnya',
        'nama_outlet.required'=>'Field Nama Outlet Wajib Diisi',
        'nama_outlet.unique' => 'Outlet ini sudah ada sebelumnya',
        'alamat_outlet.required'=>'Field Alamat Wajib Diisi',
        'no_telp_outlet.required'=> 'Field No Telp wajib diisi',
        'no_telp_outlet.max' => 'No Telp hanya boleh maksimal 12 karakter'
    );

    public static function RulesUpdate(){
         $rules= array(
           'kode_outlet_update' => 'required|max:7',
           'nama_outlet_update' => 'required',
           'alamat_outlet_update' => 'required',
           'no_telp_outlet_update' => 'required|max:12'
        );
       return $rules;
    }

    public static $messagesUpdate=array(
        'kode_outlet_update.required' => 'Field Kode Outlet Harus Diisi',
        'kode_outlet_update.max' => 'Kode Outlet hanya boleh maksimal 7 karakter',
        'nama_outlet_update.required'=>'Field Nama Outlet Wajib Diisi',
        'alamat_outlet_update.required'=>'Field Alamat Wajib Diisi',
        'no_telp_outlet_update.required'=> 'Field No Telp wajib diisi',
        'no_telp_outlet_update.max' => 'No Telp hanya boleh maksimal 12 karakter'
    );
}
