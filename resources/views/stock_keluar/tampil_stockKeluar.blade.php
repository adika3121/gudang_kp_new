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
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Tabel Stock</h2>
      </header>
      <div class="panel-body">

        <!-- Table Data Barang Master -->
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
          <thead>
            <tr>
              <th>Kode Master</th>
              <th>SN</th>
              <th>Tanggal Masuk</th>
              <th>Catatan</th>
              <th>Ket</th>
            </tr>
          </thead>
          <tbody>
            @foreach($stock_keluar as $stk_kluar)
            <tr>
                <td>{{$stk_kluar->kode_master}}</td>
                <td>{{$stk_kluar->sn}}</td>
                <td>{{$stk_kluar->created_at}}</td>
                <td>{{$stk_kluar->keterangan}}</td>
                <td><button class="on-default edit-row"
                      data-toggle="modal"
                      data-target="#editMaster">
                        <i class="fa fa-pencil"></i></button>
                    <button class="on-default remove-row"
                        data-toggle="modal"
                        data-target="#deleteMaster"
                        ><i class="fa fa-trash-o"></i></button></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <!-- Button Tambah Barang Baru -->
        <div class="row">
					<div class="col-sm-6">
						<div class="mb-md">
							<button data-toggle="modal" data-target="#tambahStockKeluar" class="btn btn-primary">Tambah Barang <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>

        <!-- modal tambah stock Keluar -->
  			<div class="modal fade" id="tambahStockKeluar" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
  				<div class="modal-dialog modal-lg" role="document">
  					<div class="modal-content">
  						<div class="modal-header">
  							<h5 class="modal-title" id="largeModalLabel">Pilih Outlet Terlebih Dahulu</h5>
  						</div>
  						<div class="modal-body">
                <div class="card" style="center">
                    <div class="card-header">
                        <strong>Pilih Outlet</strong>
                    </div>
                    <form action="{{action('TbStockKeluarController@tambah_stock_keluar')}}" method="post" class="">
                    <div class="card-body card-block">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="outlet" class=" form-control-label">Nama Outlet</label>
                                <select class="form-control" name="outlet">
                                  <@if(count($tb_outlet->all()) > 0)
                                      @foreach($tb_outlet->all() as $outlet)
                                          <option value="{{$outlet->kode_outlet}}">{{$outlet->nama_outlet}}</option>
                                      @endforeach
                                  @endif
                                </select>
                            </div>
                    </div>
                </div>
  						</div>
  						<div class="modal-footer">
  							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
  							<button type="submit" class="btn btn-primary">Lanjut</button>
  						</div>
              </form>
  					</div>
  				</div>
  			</div>
  			<!-- end modal tambah stock keluar-->


      </div>  <!-- div panel body -->
    </section> <!-- section panel-->
  <!-- end: page -->
</section>
@endsection
