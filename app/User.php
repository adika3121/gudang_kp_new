<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function isRole(){
        return $this->role; // mysql table column
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function Rules(){
         $rules= array(
           'name' => 'required',
           'email' => 'required|email|unique:users,email',
           'role' => 'required',
           'password' => 'required|min:6',
           'confirm_pass' => 'required|min:6|same:password'
        );
       return $rules;
    }

    public static $messages=array(
        'name.required'=>'Field Nama Wajib Diisi',
        'email.required'=>'Field email Wajib Diisi',
        'email.email' => 'Masukan email dengan format email yang benar',
        'email.unique' => 'Email ini sudah ada pengguna yang menggunakan',
        'role.required' => 'Field Role Dipelukan',
        'password.required'=> 'Field Password wajib diisi',
        'password.min' => 'Karakter pada password minimanl 6 karakter',
        'confirm_pass.required'=> 'Field Confirm Password wajib diisi',
        'confirm_pass.min' => 'Karakter pada confirm password minimanl 6 karakter',
        'confirm_pass.same' => 'Password tidak sama'
    );

    public static function RulesUpdate(){
         $rules= array(
           'nama_pengguna_update' => 'required',
           'email_pengguna_update' => 'required|email',
           'role_pengguna_update' => 'required'
        );
       return $rules;
    }

    public static $messagesUpdate=array(
        'nama_pengguna_update.required'=>'Field Nama Wajib Diisi',
        'email_pengguna_update.required'=>'Field email Wajib Diisi',
        'email_pengguna_update.email' => 'Masukan email dengan format email yang benar',
        'role_pengguna_update.required' => 'Field Role Dipelukan'
    );
}
