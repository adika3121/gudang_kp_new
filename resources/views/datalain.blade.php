@extends('layout.layout')

@section('title')
  Data Lainnya
@endsection

@section('content')
<!-- Section Main Content Tempat isinya berada  -->
<section role="main" class="content-body">
  <header class="page-header">
    <h2>Data Lainnya</h2>

    <div class="right-wrapper pull-right">
      <ol class="breadcrumbs">
        <li>
          <a href="index.html">
            <i class="fa fa-home"></i>
          </a>
        </li>
        <li><span>Data Lainnya</span></li>
      </ol>

      <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
  </header>

  <!-- start: page -->
  <!-- Tampilan Kategori  -->
        <div class="row">
          <div class="col-md-6">
              <section class="panel">
                <header class="panel-heading">
                  <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                  </div>

                  <h2 class="panel-title">Kategori</h2>
                </header>
                <div class="panel-body">
                  {{-- Data Kategori --}}
                              <div class="table-responsive table--no-card m-b-30 table-data">
                                  <table class="table table-borderless table-striped table-earning">
                                      {{-- <thead>
                                          <tr>
                                              <th>Data Kategori</th>
                                          </tr>
                                      </thead> --}}
                                          <tbody>
                                               @foreach($tampilKategori as $tp_ktgr)
                                              <tr>
                                                  <td>{{$tp_ktgr->nama_kategori}}</td>
                                                  <td style="float:right;">
                                                      <button class="btn btn-outline-warning" data-toggle="modal"
                                                      data-target="#editKategori"
                                                      data-kategori="{{$tp_ktgr->nama_kategori}}"
                                                      data-catid={{$tp_ktgr->kode_kategori}} ><i class="fa fa-edit"></i></button>

                                                      <button class="btn btn-danger"
                                                      data-catid={{$tp_ktgr->kode_kategori}}
                                                      data-toggle="modal"
                                                      data-target="#deleteKategori"><i class="fa fa-trash-o"></i></button>
                                                  </td>
                                              </tr>
                                              @endforeach
                                          </tbody>
                                  </table>
                              </div>
                </div>
                <footer class="panel-footer">
                  <div class="row">
                    <div class="center">
                      <button class="btn btn-primary"data-toggle="modal" data-target="#ModalKategori">+ Tambah Kategori
                      </button>
                    </div>
                  </div>
                </footer>
              </section>
            </form>
          </div>
          <!-- end kategori  -->
          <!-- Tampilan Merk -->
            <div class="col-md-6">
              <form id="form" action="forms-validation.html" class="form-horizontal">
                <section class="panel">
                  <header class="panel-heading">
                    <div class="panel-actions">
                      <a href="#" class="fa fa-caret-down"></a>
                    </div>

                    <h2 class="panel-title">Merk</h2>
                  </header>
                  <div class="panel-body">
                    {{-- Data Merk --}}
                                <div class="table-responsive table--no-card m-b-30 table-data">
                                    <table class="table table-borderless table-striped table-earning">
                                        {{-- <thead>
                                            <tr>
                                                <th>Data Merk</th>
                                            </tr>
                                        </thead> --}}
                                            <tbody>
                                              @foreach($tampilMerk as $tp_merk)
                                                 <tr>
                                                     <td>{{$tp_merk->nama_merek}}</td>
                                                     <td style="float:right;">
                                                         <button class="btn btn-outline-warning" data-toggle="modal"
                                                         data-target="#editMerk"
                                                         data-merk="{{$tp_merk->nama_merek}}"
                                                         data-idmerk={{$tp_merk->kode_merek}} ><i class="fa fa-edit"></i></button>

                                                        <button class="btn btn-danger" data-idmerk={{$tp_merk->kode_merek}} data-toggle="modal" data-target="#deleteMerk"><i class="fa fa-trash-o"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                    </table>
                                </div>
                  </div>
                  <footer class="panel-footer">
                    <div class="row">
                      <div class="center">
                        <button class="btn btn-primary"data-toggle="modal" data-target="#ModalMerk">+ Tambah Merk
                        </button>
                      </div>
                    </div>
                  </footer>
                </section>
              </form>
            </div>
            <!-- end merk  -->
          </div>

            <!-- Tampilan Vendor -->
            <div class="row">
              <div class="col-md-12">

                <form id="form" action="forms-validation.html" class="form-horizontal">
                  <section class="panel">
                    <header class="panel-heading">
                      <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                      </div>
                      <h2 class="panel-title">Vendor</h2>
                    </header>
                    <div class="panel-body">

                    {{-- Vendor --}}
                    <div class="table-responsive table--no-card m-b-30 table-data">
                        <table class="table table-borderless table-striped table-earning">
                          <thead>
                              <tr>
                                  <th>Nama Vendor</th>
                                  <th>Alamat Vendor</th>
                                  <th>No HP</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($tampilVendor as $tp_vendor)
                              <tr>
                                  <td>{{$tp_vendor->nama_vendor}}</td>
                                  <td>{{$tp_vendor->alamat}}</td>
                                  <td>{{$tp_vendor->no_telp}}</td>

                                  <td style="float:right;">
                                      <button class="btn btn-outline-warning" data-toggle="modal"
                                      data-target="#editVendor"
                                      data-namavendor="{{$tp_vendor->nama_vendor}}"
                                      data-alamatvendor="{{$tp_vendor->alamat}}"
                                      data-telpvendor="{{$tp_vendor->no_telp}}"
                                      data-idvendor={{$tp_vendor->kode_vendor}} ><i class="fa fa-edit"></i></button>

                                      <button class="btn btn-danger" data-idvendor={{$tp_vendor->kode_vendor}} data-toggle="modal" data-target="#deleteVendor"><i class="fa fa-trash-o"></i></button>

                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                        </table>
                    </div>
                    </div>
                    <footer class="panel-footer">
                      <div class="row">
                        <div class="center">
                          <button class="btn btn-primary"data-toggle="modal" data-target="#ModalVendor">+ Tambah Vendor
                          </button>
                        </div>
                      </div>
                    </footer>
                  </section>
                </form>
              </div>
              <!-- end vendor  -->
        </div>

        <!-- Tampilan Outlet -->
        <div class="row">
          <div class="col-md-12">
            <form id="form" action="forms-validation.html" class="form-horizontal">
              <section class="panel">
                <header class="panel-heading">
                  <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                  </div>
                  <h2 class="panel-title">Outlet</h2>
                </header>
                <div class="panel-body">

                {{-- Outlet --}}
                <div class="table-responsive table--no-card m-b-30 table-data">
                    <table class="table table-borderless table-striped table-earning">
                      <thead>
                        <tr>
                            <th>Kode Outlet</th>
                            <th>Nama Outlet</th>
                            <th>Alamat Outlet</th>
                            <th>No HP</th>
                            <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($tampilOutlet as $tp_outlet)
                            <tr>
                                <td>{{$tp_outlet->kode_outlet}}</td>
                                <td>{{$tp_outlet->nama_outlet}}</td>
                                <td>{{$tp_outlet->alamat}}</td>
                                <td>{{$tp_outlet->no_telp}}</td>

                                <td style="float:right;">
                                    <button class="btn btn-outline-warning" data-toggle="modal"
                                    data-target="#editOutlet"
                                    data-namaoutlet="{{$tp_outlet->nama_outlet}}"
                                    data-alamatoutlet="{{$tp_outlet->alamat}}"
                                    data-telpoutlet="{{$tp_outlet->no_telp}}"
                                    data-idoutlet={{$tp_outlet->kode_outlet}} ><i class="fa fa-edit"></i></button>

                                    <button class="btn btn-danger" data-idoutlet={{$tp_outlet->kode_outlet}} data-toggle="modal" data-target="#deleteOutlet"><i class="fa fa-trash-o"></i></button>

                                </td>
                            </tr>
                            @endforeach
                      </tbody>
                    </table>
                </div>
                </div>
                <footer class="panel-footer">
                  <div class="row">
                    <div class="center">
                      <button class="btn btn-primary"data-toggle="modal" data-target="#ModalOutlet">+ Tambah Outlet
                      </button>
                    </div>
                  </div>
                </footer>
              </section>
            </form>
          </div>
          <!-- end vendor  -->
    </div>

    {{-- Modal Kategori --}}
                <div class="modal fade" id="ModalKategori" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="largeModalLabel">Tambahkan Kategori Baru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{action('TbKategoriController@store')}}" method="post" class="">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="nf-email" class=" form-control-label">Nama Kategori</label>
                                        <input type="text" id="nf-email" name="nama_kategori" placeholder="Masukkan nama kategori.." class="form-control">
                                    </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Simpan
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">
                                        <i class="fa fa-refresh"></i> Reset
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


  <!-- end: page -->
</section>
@endsection
