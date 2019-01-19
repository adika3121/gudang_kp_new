@extends('layout.layout')

@section('title')
  Stock Keluar
@endsection

@section('stock_keluar')
  nav-active
@endsection

@section('content')
<!-- Section Main Content Tempat isinya berada  -->
<section role="main" class="content-body">
  <header class="page-header">
    <h2>Stock Keluar</h2>

    <div class="right-wrapper pull-right">
      <ol class="breadcrumbs">
        <li>
          <a href="index.html">
            <i class="fa fa-home"></i>
          </a>
        </li>
        <li><span>Stock Keluar</span></li>
      </ol>

      <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
  </header>

  <!-- start: page -->
  <form action="{{action('TbStockKeluarController@store')}}" method="post" class="form-horizontal" id="tambahStock">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Tambah Stock Keluar - {{$kode_master}}</h2>
      </header>
      <div class="panel-body">

        {{ csrf_field() }}
        <!-- Form Isi Stock Keluar -->
        <table class="table table-borderless" id="dynamic_field">
          <tr>
            <td><input type="text" id="sn" name="sn" placeholder="Masukan Kode SN" class="form-control"></td>
            <input type="hidden" id="outlet" name="outlet" value="{{$nama_outlet}}"placeholder="Kode PN" class="form-control">
            <input  type="hidden" id="id_master" name="id_master" value="{{$id_master}}"placeholder="Kode PN" class="form-control">
            <input  type="hidden" id="kode_master" name="kode_master" value="{{$kode_master}}"placeholder="Kode PN" class="form-control">
            <input type="hidden" id="keterangan" name="keterangan" value="{{$ket}}"placeholder="Kode PN" class="form-control">
            <!-- <td><button type="button" name"add" id="add" class="btn btn-warning add">Tambah Kode SN</button></td> -->
          </tr>
        </table>
        <!-- End input stock Keluar -->

        <!-- Button Tambah Barang Baru -->
        <div class="row">
					<div class="col-sm-6">
						<div class="mb-md">
              <button type="submit" data-toggle="modal" data-target="#tambahStockKeluar" class="btn btn-primary">Submit <i class="fa fa-plus"></i></button>
              <a href="/stock-keluar" class="btn btn-warning">Selesai</a>
						</div>
					</div>
				</div>
        <!-- End button  -->

      </form> <!-- end form input data stock-->


      </div>  <!-- div panel body -->
    </section> <!-- section panel-->
  <!-- end: page -->
</section>
@endsection
