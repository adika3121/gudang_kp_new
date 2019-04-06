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
            <a href="/stock_keluar">
              <i class="fa fa-home"></i>
            </a>
          </li>
          <li><span>Tambah SN Stock Keluar</span></li>
        </ol>

        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
      </div>
    </header>

    <!-- start: page -->
  
      <!-- Start Form -->
    <form action="{{action('TbStockKeluarController@store_sn')}}" method="post" class="form-horizontal" id="tambahStock">
      <section class="panel">
        @if ($errors->any())
          @if($errors->first('success'))
          <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong> {{ $errors->first('success') }} </strong>
          </div>
          @endif
        @endif
        <header class="panel-heading">
          <h3 class="panel-title">Tambah Serial Number</h3>
        </header>
        <div class="panel-body">
          {{ csrf_field() }}

          <!-- Form Isi Stock Keluar -->
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="keterangan" class=" form-control-label">Catatan</label>
              </div>
              <div class="col-12 col-md-9">
                @if(!empty($ket) > 0)
                    <input type="text" name="keterangan" value="{{ $ket }}" class="form-control">
                @else
                    <input type="text" name="keterangan" value="" class="form-control">
                @endif
                  <!-- <textarea type="text" id="keterangan" rows="9" name="keterangan" placeholder="Masukan Catatan.." class="form-control"></textarea> -->
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="sn" class=" form-control-label">Kode SN <span class="required">*</span></label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="text" id="sn" name="sn" placeholder="Masukan Kode SN" class="form-control" autofocus>
                  @if ($errors->any())
                    @if($errors->first('sn'))
                    <div class="alert alert-warning">
                      <li>{{ $errors->first('sn') }}</li>
                    </div>
                    @endif
                  @endif
              </div>
          </div>


          <!-- End input stock Keluar -->

          <!-- Button Tambah SN Baru -->
          <div class="row">
            <div class="col-sm-6">
              <div class="mb-md">
                <button type="submit" data-toggle="modal" data-target="#tambahStockKeluar" class="btn btn-primary">Tambahkan <i class="fa fa-plus"></i></button>
                <a href="/stock-keluar" class="btn btn-warning">Kembali ke Tabel Stock Keluar</a>
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
