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
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Tabel Transaksi Barang</h2>
      </header>
      <div class="panel-body">

        <!-- Table Data Barang Master -->
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
          <thead>
            <tr>
              <th>Kode Master</th>
              <th>SN</th>
              <th>Vendor</th>
              <th>Waktu Masuk</th>
              <th>Catatan</th>
              <th>Ket</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tampilTransaksi as $tp_transaksi)
            <tr>
                <td>{{$tp_transaksi->kode_master}}</td>
                <td>{{$tp_transaksi->sn}}</td>
                <td>{{$tp_transaksi->tb_vendor['nama_vendor']}}</td>
                <td>{{$tp_transaksi->created_at}}</td>
                <td>{{$tp_transaksi->keterangan}}</td>
                <td><button class="on-default edit-row"
                      data-toggle="modal"
                      data-target="#editTransaksi"
                      data-keterangan_transaksi="{{$tp_transaksi->keterangan}}"
                      data-vendor_transaksi="{{$tp_transaksi->vendor}}"
                      data-kode_transaksi={{$tp_transaksi->kode_transaksi}}>
                        <i class="fa fa-pencil"></i></button>

                      <button class="on-default remove-row"
                      data-toggle="modal"
                      data-target="#deleteTransaksi"
                      data-kode_master="{{$tp_transaksi->kode_master}}"
                      data-kode_transaksi={{$tp_transaksi->kode_transaksi}}
                      ><i class="fa fa-trash-o"></i></button>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <!-- Button Tambah Barang Baru -->
        <div class="row">
					<div class="col-sm-6">
						<div class="mb-md">
							<button data-toggle="modal" data-target="#tambahTransaksi" class="btn btn-primary">Tambah Transaksi Masuk <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
        <!--  -->

        <!-- Modal Tambah Transaksi -->
    			<div class="modal fade" id="tambahTransaksi" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    				<div class="modal-dialog modal-lg" role="document">
    					<div class="modal-content">
    						<div class="modal-header">
    							<h5 class="modal-title" id="largeModalLabel"><strong>Pilih Outlet Terlebih Dahulu</strong></h5>
    						</div>
    						<div class="modal-body">
                  <div class="card" style="center">
                      <div class="card-header">
                      </div>
                      <form action="{{action('PenerimaanTransaksiController@outlet')}}" method="post" class="">
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
  			<!-- end modal tambah transaksi -->

        <!-- modal update -->
          <div class="modal fade" id="editTransaksi" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="largeModalLabel">Edit Catatan</h5>
                      </div>
                      <div class="modal-body">
                          <form action="{{route('transaksi.update','test')}}" method="post" class="">
                              {{method_field('patch')}}
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label for="vendor" class=" form-control-label">Nama Vendor</label>
                                  <input type="hidden" id="kode_transaksi" name="kode_transaksi" value="">
                                  <select name="vendor" id="vendor" class="form-control">
                                  <@if(count($vendor->all()) > 0)
                                      @foreach($vendor->all() as $vnd)
                                          <option value="{{$vnd->kode_vendor}}">{{$vnd->nama_vendor}}</option>
                                      @endforeach
                                  @endif
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label for="keterangan" class=" form-control-label">Catatan</label>
                                  <input type="hidden" id="kode_transaksi" name="kode_transaksi" value="">
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
    			<!-- end modal large -->

      <!-- Modal delete transaksi  -->
      <div class="modal fade" id="deleteTransaksi" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="largeModalLabel">Delete Transaksi</h5>
                      </div>
                      <div class="modal-body">
                          <form action="{{route('transaksi.destroy','test')}}" method="post">
                              {{method_field('delete')}}
                              {{csrf_field()}}
                              <p class="text-center">
                                  Yakin untuk menghapus transaksi ini?
                              </p>
                              <input type="hidden" name="kode_master" id="kode_master" value="">
                              <input type="hidden" id="kode_transaksi" name="kode_transaksi" value="">
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

@section('script_transaksi')
<script>
  $('#editTransaksi').on('show.bs.modal', function (event) {

              var button = $(event.relatedTarget)
              var keterangan_transaksi = button.data('keterangan_transaksi')
              var vendor_transaksi = button.data('vendor_transaksi')
              var kode_transaksi = button.data('kode_transaksi')
              var modal = $(this)

              modal.find('.modal-body #keterangan').val(keterangan_transaksi);
              modal.find('.modal-body #vendor').val(vendor_transaksi);
              modal.find('.modal-body #kode_transaksi').val(kode_transaksi);
          })

          $('#deleteTransaksi').on('show.bs.modal', function (event) {

              var button = $(event.relatedTarget)
              var kode_master = button.data('kode_master')
              var kode_transaksi = button.data('kode_transaksi')
              var modal = $(this)

              modal.find('.modal-body #kode_master').val(kode_master);
              modal.find('.modal-body #kode_transaksi').val(kode_transaksi);
          })
</script>
@endsection
