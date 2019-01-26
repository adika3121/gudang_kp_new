@extends('layout.layout-penerimaan')

@section('title')
  Transaksi Barang Masuk
@endsection

@section('transaksi')
  nav-active
@endsection

@section('content')
<!-- Section Main Content Tempat isinya berada  -->
<section role="main" class="content-body">
  <header class="page-header">
    <h2>Transaksi Barang</h2>

    <div class="right-wrapper pull-right">
      <ol class="breadcrumbs">
        <li>
          <a href="index.html">
            <i class="fa fa-home"></i>
          </a>
        </li>
        <li><span>Transaksi Barang</span></li>
      </ol>

      <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
  </header>

  <!-- start: page -->
    <form id="form" action="{{action('PenerimaanTransaksiController@tambah_transaksi_sn')}}" method="post" class="form-horizontal">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Tambah Transaksi Barang</h2>
      </header>
      <div class="panel-body">
        {{ csrf_field() }}
        <!-- Data dari View sebelumnya di hide -->
        <input type="hidden" name="outlet" value="{{$nama_outlet}}">
        <input type="hidden" name="kode_master" value="{{$kode_master}}">
        <input type="hidden" name="id_master" value="{{$id_master}}">
        <input type="hidden" name="kode_vendor" value="{{$vendor}}">

        <!-- Konfimasi Message-->
        <p class="text-center">
            Stock Berhasil Masuk <br>
            Tambah Lagi?
        </p>

        <!-- Button Tambah Transaksi SN -->
        <div class="row">
					<div class="col-sm-6">
						<div class="mb-md">
              <a href="/penerimaan-transaksi" class="btn btn-warning">Tidak</a>
							<button type="submit" data-toggle="modal" data-target="#tambahTransaksiSN" class="btn btn-primary">Iya</button>
						</div>
					</div>
				</div>
        <!--  -->
        </form>


      </div>  <!-- div panel body -->
    </section> <!-- section panel-->
  <!-- end: page -->
</section>
@endsection
