<?php

namespace App\Exports;

use App\tb_transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class transaksiExport implements FromView
{


    public $data;

    // public function k_master(String $kode_master){
    //     $this->kode_master = $kode_master;
    //
    //     return $this;
    // }
    //
    // public function headings(): array
    // {
    //     return [
    //         'Kode Transaksi',
    //         'Kode Master',
    //         'SN',
    //         'Tanggal Masuk',
    //         'Keterangan',
    //     ];
    // }
    //
    // /**
    // * @var tb_transaksi $tb_transaksi
    // */
    // public function map($tb_transaksi): array
    // {
    //     $transaksi = tb_transaksi::where('kode_master', $this->kode_master)
    //                         ->select('tb_transaksi.kode_transaksi as kode_trans',
    //                                   'tb_transaksi.kode_master as kode_master',
    //                                   'tb_transaksi.sn as sn',
    //                                   'tb_transaksi.created_at as  waktu_masuk',
    //                                   'tb_transaksi.keterangan as catatan')
    //                         ->get();
    //     return [
    //         $transaksi->kode_trans,
    //         $transaksi->kode_master,
    //         $transaksi->sn,
    //         $transaksi->waktu_masuk,
    //         $transaksi->catatan,
    //     ];
    // }

    // public function query(){
    //     $transaksi = tb_transaksi::where('kode_master', $this->kode_master)
    //                     ->select('tb_transaksi.kode_transaksi as kode_trans',
    //                               'tb_transaksi.kode_master as kode_master',
    //                               'tb_transaksi.sn as sn',
    //                               'tb_transaksi.created_at as  waktu_masuk',
    //                               'tb_transaksi.keterangan as catatan')
    //                     ->get();
    //     return tb_transaksi::query()->where('kode_master', $this->kode_master);
    // }

    public function __construct($data){
      $this->data = $data;
    }

    public function view(): View
    {
      return view('exports.transaksi-sisa');
    }

}
