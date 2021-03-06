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
              <th>Outlet</th>
              <th>SN</th>
              <th>Waktu Keluar</th>
              <th>Catatan</th>
              <th>Status</th>
              <th>Ket</th>
            </tr>
          </thead>
          <tbody>
            @foreach($stock_keluar as $stk_kluar)
            <tr>
                <td>{{$stk_kluar->kode_master}}</td>
                <td>{{$stk_kluar->tb_outlet->nama_outlet}}</td>
                <td>{{$stk_kluar->sn}}</td>
                <td>{{$stk_kluar->created_at}}</td>
                <td>{{$stk_kluar->keterangan}}</td>
                <td>{{$status_jadi[$stk_kluar->status]}}</td>
                <td><button class="btn btn-outline-warning on-default edit-row"
                      data-toggle="modal"
                      data-target="#editStockKeluar"
                      data-keterangan_keluar="{{$stk_kluar->keterangan}}"
                      data-sn_keluar="{{$stk_kluar->sn}}"
                      data-kode_keluar={{$stk_kluar->kode_keluar}}>
                        <i class="fa fa-pencil"></i></button>
                    @if($stk_kluar->status!='1')
                        <button class="btn btn-danger on-default remove-row"
                            data-toggle="modal"
                            data-target="#deleteStockKeluar"
                            data-kode_master="{{$stk_kluar->kode_master}}"
                            data-kode_keluar="{{$stk_kluar->kode_keluar}}"
                            data-sn="{{$stk_kluar->sn}}"
                            >Batal</button></td>
                    @else
                        <button class="btn btn-outline-warning">Batal</button>
                    @endif
            </tr>
            @endforeach
          </tbody>
        </table>
        <!-- Button Tambah Barang Baru -->
        <form action="{{action('TbStockKeluarController@tambah_stock_keluar')}}" method="post" class="">
          {{ csrf_field() }}
          <div class="row">
  					<div class="col-sm-6">
  						<div class="mb-md">
  							<button type="submit" class="btn btn-primary">Keluarkan Barang <i class="fa fa-plus"></i></button>
  						</div>
  					</div>
  				</div>
        </form>


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
  							<button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
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
                                  <input type="text" id="keterangan" name="keterangan" class="form-control" value="{{old('keterangan')}}">
                              </div>
                              <div class="row form-group">
                                  <div class="col col-md-3">
                                      <label for="text-input" class=" form-control-label">Kode SN <span class="required">*</span></label>
                                  </div>
                                  <div class="col-12 col-md-9">
                                      <input type="text" id="sn" name="sn" placeholder="SN" class="form-control" value="{{ old('sn') }}" autofocus>
                                      @if ($errors->any())
                                        @if($errors->first('sn'))
                                        <div class="alert alert-warning">
                                          <li>{{ $errors->first('sn') }}</li>
                                        </div>
                                        @endif
                                        @endif
                                  </div>
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
                            <h5 class="modal-title" id="largeModalLabel">Batalkan Transaksi</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{action('TbStockKeluarController@destroy')}}" method="post">

                                {{csrf_field()}}
                                <p class="text-center">
                                    Yakin untuk membatalkan stock keluar ini?
                                </p>
                                <input type="hidden" name="kode_master" id="kode_master" value="">
                                <input type="hidden" id="kode_keluar" name="kode_keluar" value="">
                                <input type="hidden" name="sn" id="sn" value="">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-danger">Ya, Batalkan Transaksi</button>
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
@if ($errors->any())
  @if($errors->first('sn'))
    $('#editStockKeluar').modal('show');
  @endif
@endif
  $('#editStockKeluar').on('show.bs.modal', function (event) {

              var button = $(event.relatedTarget)
              var keterangan_keluar = button.data('keterangan_keluar')
              var kode_keluar = button.data('kode_keluar')
              var sn_keluar = button.data('sn_keluar')
              var modal = $(this)

              modal.find('.modal-body #keterangan').val(keterangan_keluar);
              modal.find('.modal-body #sn').val(sn_keluar);
              modal.find('.modal-body #kode_keluar').val(kode_keluar);
          })

    $('#deleteStockKeluar').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var kode_master = button.data('kode_master')
        var kode_keluar = button.data('kode_keluar')
        var sn = button.data('sn')
        var modal = $(this)

        modal.find('.modal-body #kode_master').val(kode_master);
        modal.find('.modal-body #kode_keluar').val(kode_keluar);
        modal.find('.modal-body #sn').val(sn);
    })
</script>
@endsection
