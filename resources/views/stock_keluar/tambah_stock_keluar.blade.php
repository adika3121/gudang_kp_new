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
        <li><span>Tambah Stock Keluar</span></li>
      </ol>

      <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
  </header>

  <!-- start: page -->
  <form action="{{action('TbStockKeluarController@tambah_sn_keluar')}}" method="post" class="form-horizontal">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Tambah Stock Keluar</h2>
      </header>
      <div class="panel-body">

        {{ csrf_field() }}
        <!-- Form Isi Stock Keluar -->
        <input type="hidden" id="outlet" name="outlet" value="{{$nama_outlet}}"placeholder="Kode PN" class="form-control">
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="kode_master" class=" form-control-label">Nama Barang</label>
            </div>
            <div class="col-12 col-md-9">
                <select name="id_master" id="#" class="form-control">
                    <@if(count($nama_barang->all()) > 0)
                        @foreach($nama_barang->all() as $brg)
                            <option value="{{$brg->id_master}}">{{$brg->nama_barang}}</option>
                        @endforeach
                @endif
                </select>
                @if ($errors->any())
                  @if($errors->first('id_master'))
                  <div class="alert alert-warning">
                    <li>{{ $errors->first('id_master') }}</li>
                  </div>
                  @endif
                  @endif
            </div>
        </div>

        <!-- End input stock Keluar -->

        <!-- Button Tambah Barang Baru -->
        <div class="row">
					<div class="col-sm-6">
						<div class="mb-md">
							<button type="submit" data-toggle="modal" data-target="#tambahSN" class="btn btn-primary">Tambah SN <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
        <!-- End button  -->

      </form> <!-- end form input data stock-->


      </div>  <!-- div panel body -->
    </section> <!-- section panel-->
  <!-- end: page -->
  {{--  <!-- modal tambah sn Keluar -->
  			<div class="modal fade" id="tambahSN" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
  				<div class="modal-dialog modal-lg" role="document">
  					<div class="modal-content">
  						<div class="modal-header">
  							<h5 class="modal-title" id="largeModalLabel"><strong>Pilih Outlet Terlebih Dahulu</strong></h5>
  						</div>
  						<div class="modal-body">
                <div class="card" style="center">
                    <form action="{{action('TbStockKeluarController@store')}}" method="post" class="form-horizontal" id="tambahStock">
                      {{ csrf_field() }}
                      <!-- Form Isi Stock Keluar -->
                      <div class="row form-group">
                          <div class="col col-md-3">
                              <label for="sn" class=" form-control-label">Kode SN</label>
                          </div>
                          <div class="col-12 col-md-9">
                              <input type="text" id="sn" name="sn" placeholder="Masukan Kode SN" class="form-control">
                              <input type="hidden" id="outlet" name="outlet" value="{{$nama_outlet}}" class="form-control">
                              <input  type="hidden" id="id_master" name="id_master" value="{{$id_master}}" class="form-control">
                              <input  type="hidden" id="kode_master" name="kode_master" value="{{$kode_master}}" class="form-control">
                              <input type="hidden" id="keterangan" name="keterangan" value="{{$ket}}" class="form-control">
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3">
                              <label for="keterangan" class=" form-control-label">Catatan</label>
                          </div>
                          <div class="col-12 col-md-9">
                              <textarea type="text" id="kode_pn" rows="9" name="keterangan" placeholder="Masukan Catatan.." class="form-control"></textarea>
                          </div>
                      </div>
                      <!-- End input stock Keluar -->

                      <!-- Button Tambah SN Baru -->
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="mb-md">
                            <button type="submit" data-toggle="modal" data-target="#tambahStockKeluar" class="btn btn-primary">Submit <i class="fa fa-plus"></i></button>
                            <a href="/stock-keluar" class="btn btn-warning">Selesai</a>
                          </div>
                        </div>
                      </div>
                      <!-- End button  -->

                    </form>
                </div>
  					  </div>
  				  </div>
          </div>
  		  </div>
  			<!-- end modal tambah stock keluar-->  --}}
</section>
@endsection
