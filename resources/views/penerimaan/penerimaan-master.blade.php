@extends('layout.layout-penerimaan')

@section('title')
  Master Barang
@endsection

@section('master')
  nav-active
@endsection

@section('content')
<!-- Section Main Content Tempat isinya berada  -->
<section role="main" class="content-body">
  <header class="page-header">
    <h2>Master Barang</h2>

    <div class="right-wrapper pull-right">
      <ol class="breadcrumbs">
        <li>
          <a href="index.html">
            <i class="fa fa-home"></i>
          </a>
        </li>
        <li><span>Master Barang</span></li>
      </ol>

      <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
  </header>

  <!-- start: page -->
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Tabel Master Data Barang</h2>
      </header>
      <div class="panel-body">

        <!-- Table Data Barang Master -->
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
          <thead>
            <tr>
              <th>Kode Master</th>
              <th>Kode Outlet</th>
              <th>Kategori</th>
              <th>Kode PN</th>
              <th>Merk</th>
              <th>Nama Barang</th>
              <th>Stock Masuk</th>
              <th>Stock Keluar</th>
              <th>Stock Gudang</th>
              <th class="hidden-phone">Catatan</th>
              <th class="hidden-phone">Ket</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tampilBarang as $tp_brg)
              <tr>
                  <td>{{$tp_brg->kode_master}}</td>
                  <td class="kode_outlet">{{$tp_brg->kode_outlet}}</td>
                  <td class="nama_kategori">{{$tp_brg->tb_kategori['nama_kategori']}}</td>
                  <td class="kode_pn">{{$tp_brg->kode_pn}}</td>
                  <td class="nama_merek">{{$tp_brg->tb_merek['nama_merek']}}</td>
                  <td class="nama_barang">{{$tp_brg->nama_barang}}</td>
                  <td class="text-right">{{$tp_brg->stock_masuk}}</td>
                  <td class="text-right">{{$tp_brg->stock_keluar}}</td>
                  <td class="text-right">{{$tp_brg->sisa_stock}}</td>
                  <td class="catatan">{{$tp_brg->keterangan}}</td>
                  <td><button class="on-default edit-row"
                        data-toggle="modal"
                        data-target="#editMaster"
                        data-keterangan="{{$tp_brg->keterangan}}"
                        data-id_master={{$tp_brg->id_master}}>
                          <i class="fa fa-pencil"></i></button>
                      <button class="on-default remove-row"
                          data-toggle="modal"
                          data-target="#deleteMaster"
                          data-id_master={{$tp_brg->id_master}}
                          ><i class="fa fa-trash-o"></i></button></td>
              </tr>
              @endforeach
          </tbody>
        </table>
        <!-- Button Tambah Barang Baru -->
        <div class="row">
					<div class="col-sm-6">
						<div class="mb-md">
							<button data-toggle="modal" data-target="#tambahMaster" class="btn btn-primary">Tambah Barang <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>

        <!-- modal tambah barang -->
  			<div class="modal fade" id="tambahMaster" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
  				<div class="modal-dialog modal-lg" role="document">
  					<div class="modal-content">
  						<div class="modal-header">
  							<h5 class="modal-title" id="largeModalLabel">Tambah Barang</h5>
  						</div>
              <form action="{{action('PenerimaanMasterController@store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                  {{ csrf_field() }}
  						<div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="select" class=" form-control-label">Outlet <span class="required">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="outlet" id="outlet" class="form-control">
                                <@if(count($outlet->all()) > 0)
                                    @foreach($outlet->all() as $outlet)
                                        <option value="{{$outlet->kode_outlet}}">{{$outlet->nama_outlet}}</option>
                                    @endforeach
                            @endif
                            </select>
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="select" class=" form-control-label">Kategori <span class="required">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="kategori" id="kategori" class="form-control">
                            <@if(count($kategori->all()) > 0)
                                @foreach($kategori->all() as $kategori)
                                    <option value="{{$kategori->kode_kategori}}">{{$kategori->nama_kategori}}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Nama Barang <span class="required">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="nama_barang" name="nama_barang" placeholder="Nama Barang" class="form-control" value="{{old('nama_barang')}}">
                                @if ($errors->first('nama_barang'))
                                  <div class="alert alert-warning">
                                    <li>{{ $errors->first('nama_barang') }}</li>
                                  </div>
                                  @endif
                            </div>
                        </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="select" class=" form-control-label">Merk <span class="required">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="merk" id="merk" class="form-control">
                            <@if(count($merk->all()) > 0)
                                @foreach($merk->all() as $merk)
                                    <option value="{{$merk->kode_merek}}">{{$merk->nama_merek}}</option>
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
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Kode PN <span class="required">*</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="kode_pn" name="kode_pn" placeholder="Kode PN" class="form-control">
                            @if ($errors->any())
                              @if($errors->first('kode_pn'))
                              <div class="alert alert-warning">
                                <li>{{ $errors->first('kode_pn') }}</li>
                              </div>
                              @endif
                              @endif
                        </div>
                    </div>
  						</div>
  						<div class="modal-footer">
  							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
  							<button type="submit" class="btn btn-primary">Confirm</button>
              </form>
  						</div>
  					</div>
  				</div>
  			</div>
  			<!-- end modal tambah barang -->

        <!-- modal update -->
      <div class="modal fade" id="editMaster" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="largeModalLabel">Edit Catatan</h5>
                  </div>
                  <div class="modal-body">
                      <form action="{{route('master.update','test')}}" method="post" class="">
                          {{method_field('patch')}}
                          {{ csrf_field() }}
                          <div class="form-group">
                              <label for="keterangan" class=" form-control-label">Catatan</label>
                              <input type="hidden" id="id_master" name="id_master" value="">
                              <input type="text" id="keterangan" name="keterangan" class="form-control" required>
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
			<!-- end modal Update -->

      <!-- Modal delete master  -->
      <div class="modal fade" id="deleteMaster" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="largeModalLabel">Delete Barang</h5>
                      </div>
                      <div class="modal-body">
                          <form action="{{route('master.destroy','test')}}" method="post">
                              {{method_field('delete')}}
                              {{csrf_field()}}
                              <p class="text-center">
                                  Yakin untuk menghapus barang ini?
                              </p>
                              <input type="hidden" id="id_master" name="id_master" value="">
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

@section('script_master')
<script>
@if (count($errors) > 0)
    $('#tambahMaster').modal('show');
@endif

$('#editMaster').on('show.bs.modal', function (event) {

              var button = $(event.relatedTarget)
              var keterangan = button.data('keterangan')
              var id_master = button.data('id_master')
              var modal = $(this)

              modal.find('.modal-body #keterangan').val(keterangan);
              modal.find('.modal-body #id_master').val(id_master);
          })

$('#deleteMaster').on('show.bs.modal', function (event) {

              var button = $(event.relatedTarget)
              var id_master = button.data('id_master')
              var modal = $(this)

              modal.find('.modal-body #id_master').val(id_master);
          })
</script>
@endsection
