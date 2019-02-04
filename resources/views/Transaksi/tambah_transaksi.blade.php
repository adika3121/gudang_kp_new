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
    <form id="form" action="{{action('TbTransaksiController@tambah_transaksi_sn')}}" method="post" class="form-horizontal">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Tambah Transaksi Barang</h2>
      </header>
      <div class="panel-body">
        {{ csrf_field() }}
        <input type="hidden" id="kode_pn" name="outlet" value="{{$nama_outlet}}"placeholder="Kode PN" class="form-control">
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="select" class=" form-control-label">Nama Barang</label>
            </div>
            <div class="col-12 col-md-9">
                <select name="id_master" id="outlet" class="form-control">
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
                <label for="select" class=" form-control-label">Nama Vendor</label>
            </div>
            <div class="col-12 col-md-9">
                <select name="kode_vendor" id="kategori" class="form-control">
                <@if(count($vendor->all()) > 0)
                    @foreach($vendor->all() as $vnd)
                        <option value="{{$vnd->kode_vendor}}">{{$vnd->nama_vendor}}</option>
                    @endforeach
                @endif
                </select>
            </div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3">
              <label for="text-input" class=" form-control-label">Catatan</label>
          </div>
          <div class="col-12 col-md-9">
              <textarea id="keterangan" name="keterangan" placeholder="..." class="form-control"></textarea>
          </div>
        </div>
        <!-- Button Tambah Barang Baru -->
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
