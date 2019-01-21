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
        <h2 class="panel-title">Tabel Stock Keluar</h2>
      </header>
      <div class="panel-body">

        <!-- Table Data Barang Master -->
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
          <thead>
            <tr>
              <th>Kode Master</th>
              <th>SN</th>
              <th>Tanggal Keluar</th>
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
                      data-target="#editStockKeluar"
                      data-keterangan_keluar="{{$stk_kluar->keterangan}}"
                      data-kode_keluar={{$stk_kluar->kode_keluar}}>
                        <i class="fa fa-pencil"></i></button>
                    <button class="on-default remove-row"
                        data-toggle="modal"
                        data-target="#deleteStockKeluar"
                        data-kode_master="{{$stk_kluar->kode_master}}"
                        data-kode_keluar={{$stk_kluar->kode_keluar}}
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
  							<h5 class="modal-title" id="largeModalLabel"><strong>Pilih Outlet Terlebih Dahulu</strong></h5>
  						</div>
  						<div class="modal-body">
                <div class="card" style="center">

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

        <!-- modal update -->
          <div class="modal fade" id="editStockKeluar" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="largeModalLabel">Edit Stock Keluar</h5>
                      </div>
                      <div class="modal-body">
                          <form action="{{route('stock-keluar.update','test')}}" method="post" class="">
                              {{method_field('patch')}}
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label for="keterangan" class=" form-control-label">Catatan</label>
                                  <input type="hidden" id="kode_keluar" name="kode_keluar" value="">
                                  <input type="text" id="keterangan" name="keterangan" class="form-control">
                              </div>
                              <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary btn-sm">
                                      <i class="fa fa-dot-circle-o"></i> Simpan
                                  </button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
    			<!-- end modal update -->

        <!-- Modal delete stock Keluar  -->
        <div class="modal fade" id="deleteStockKeluar" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="largeModalLabel">Delete Transaksi</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('stock-keluar.destroy','test')}}" method="post">
                                {{method_field('delete')}}
                                {{csrf_field()}}
                                <p class="text-center">
                                    Yakin untuk menghapus stock keluar ini?
                                </p>
                                <input type="hidden" name="kode_master" id="kode_master" value="">
                                <input type="hidden" id="kode_keluar" name="kode_keluar" value="">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Delete -->


      </div>  <!-- div panel body -->
    </section> <!-- section panel-->
  <!-- end: page -->
</section>
@endsection

@section('script_stock_keluar')
<script>
  $('#editStockKeluar').on('show.bs.modal', function (event) {

              var button = $(event.relatedTarget)
              var keterangan_keluar = button.data('keterangan_keluar')
              var kode_keluar = button.data('kode_keluar')
              var modal = $(this)

              modal.find('.modal-body #keterangan').val(keterangan_keluar);
              modal.find('.modal-body #kode_keluar').val(kode_keluar);
          })

    $('#deleteStockKeluar').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var kode_master = button.data('kode_master')
        var kode_keluar = button.data('kode_keluar')
        var modal = $(this)

        modal.find('.modal-body #kode_master').val(kode_master);
        modal.find('.modal-body #kode_keluar').val(kode_keluar);
    })
</script>
@endsection
