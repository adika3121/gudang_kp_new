@extends('layout.layout')

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
          <a href="/transaksi">
            <i class="fa fa-home"></i>
          </a>
        </li>
        <li><span>Kode SN Transaksi</span></li>
      </ol>

      <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
  </header>

  <!-- start: page -->
    <form id="form" action="{{action('TbTransaksiController@store')}}" method="post" class="snTransaksi">
      <section class="panel">
        <header class="panel-heading">
          <h2 class="panel-title">Tambah Transaksi Barang</h2>
        </header>
        <div class="panel-body">
          {{ csrf_field() }}
          <!-- Data dari View sebelumnya di hide -->
          <input type="hidden" name="nama_outlet" value="{{$nama_outlet}}">
          <input type="hidden" name="kode_master" value="{{$kode_master}}">
          <input type="hidden" name="id_master" value="{{$id_master}}">
          <input type="hidden" name="vendor" value="{{$vendor}}">

          <!-- Form Mengisi Catatn dan SN -->
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Catatan</label>
              </div>
              <div class="col-12 col-md-9">
                  <textarea id="kode_pn" name="keterangan" placeholder="..." class="form-control"></textarea>
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Kode SN <span class="required">*</span></label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="text" id="sn" name="sn" placeholder="SN" class="form-control">
                  @if ($errors->any())
                    @if($errors->first('sn'))
                    <div class="alert alert-warning">
                      <li>{{ $errors->first('sn') }}</li>
                    </div>
                    @endif
                    @endif
              </div>
          </div>
          <!-- Button Tambah Transaksi SN -->
          <div class="row">
  					<div class="col-sm-6">
  						<div class="mb-md">
  							<button data-toggle="modal" data-target="#tambahTransaksi" class="btn btn-primary">Tambah Transaksi Masuk <i class="fa fa-plus"></i></button>
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
