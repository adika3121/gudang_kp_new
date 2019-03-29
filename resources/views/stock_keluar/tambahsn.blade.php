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
    {{--  <!-- <table class="table table-bordered table-striped mb-none">
        <thead>
          <tr>
            <th><strong>Kode Master</strong></th>
            <th><strong>Nama outlet</strong></th>
          </tr>
        </thead>
        <tbody>
          <tr>
              <td>{{$kode_master}}</td>
              <td>{{$nama_outlet}}</td>
          </tr>
        </tbody>
      </table> -->  --}}
    <form action="{{action('TbStockKeluarController@store')}}" method="post" class="form-horizontal" id="tambahStock">
      <section class="panel">
        {{--  @if ($errors->any())
          @if($errors->first('success'))
          <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong> {{ $errors->first('success') }} </strong>
          </div>
          @endif
        @endif  --}}
        <header class="panel-heading">
          <h3 class="panel-title">Tambah Serial Number</h3>
        </header>
        <div class="panel-body">

            {{--  <input type="hidden" id="outlet" name="outlet" value="{{$nama_outlet}}" class="form-control">
            <input  type="hidden" id="id_master" name="id_master" value="{{$id_master}}" class="form-control">
            <input  type="hidden" id="kode_master" name="kode_master" value="{{$kode_master}}" class="form-control">  --}}

          {{ csrf_field() }}

          <!-- Nama barang -->
          {{--  <div class="row form-group">
              <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Nama Barang</label>
              </div>
              <div class="col-12 col-md-9">
                <input type="text" name="nama_barang" value="{{$nama_lainnya->nama_barang}}" class="form-control" disabled>

                  <!-- <textarea id="kode_pn" name="keterangan" placeholder="..." value="" class="form-control"></textarea> -->
              </div>
          </div>  --}}

          <!-- nama outlet -->
          {{--  <div class="row form-group">
              <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Nama Outlet</label>
              </div>
              <div class="col-12 col-md-9">
                <input type="text" name="name_out" value="{{$nama_lainnya->nama_outlet}}" class="form-control" disabled>

                  <!-- <textarea id="kode_pn" name="keterangan" placeholder="..." value="" class="form-control"></textarea> -->
              </div>
          </div>  --}}
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
                <button type="submit" class="btn btn-primary">Tambahkan <i class="fa fa-plus"></i></button>
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
