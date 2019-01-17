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
  <form action="{{action('TbStockKeluarController@tambah_sn_keluar')}}" method="post" class="form-horizontal">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Tambah Stock Keluar</h2>
      </header>
      <div class="panel-body">

        {{ csrf_field() }}
        <!-- Form Isi Stock Keluar -->
        <input type="hidden" id="kode_pn" name="outlet" value="{{$nama_outlet}}"placeholder="Kode PN" class="form-control">
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

        <!-- Button Tambah Barang Baru -->
        <div class="row">
					<div class="col-sm-6">
						<div class="mb-md">
							<button type="submit" data-toggle="modal" data-target="#tambahStockKeluar" class="btn btn-primary">Tambah SN <i class="fa fa-plus"></i></button>
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
