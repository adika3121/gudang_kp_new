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
                              <div class="table-responsive table--no-card m-b-30 table-wrapper-scroll-y">
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
                <section class="panel">
                  <header class="panel-heading">
                    <div class="panel-actions">
                      <a href="#" class="fa fa-caret-down"></a>
                    </div>

                    <h2 class="panel-title">Merk</h2>
                  </header>
                  <div class="panel-body">
                    {{-- Data Merk --}}
                                <div class="table-responsive table--no-card m-b-30 table-wrapper-scroll-y">
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
                  <section class="panel">
                    <header class="panel-heading">
                      <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                      </div>
                      <h2 class="panel-title">Vendor</h2>
                    </header>
                    <div class="panel-body">

                    {{-- Vendor --}}
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning"  id="datatable-tabletools">
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
              <section class="panel">
                <header class="panel-heading">
                  <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                  </div>
                  <h2 class="panel-title">Outlet</h2>
                </header>
                <div class="panel-body">
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning"  id="datatable-tabletools">
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
                {{-- Modal update kategori --}}
                <div class="modal fade" id="editKategori" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="largeModalLabel">Edit Kategori</h5>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('kategori.update','test')}}" method="post" class="">
                                    {{method_field('patch')}}
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="nama_kategori" class=" form-control-label">Nama Kategori</label>
                                        <input type="hidden" id="kode_kategori" name="kode_kategori" value="">
                                        <input type="text" id="nama_kategori" name="nama_kategori" class="form-control">
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

                {{-- Modal delete kategori --}}
                <div class="modal fade" id="deleteKategori" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="largeModalLabel">Delete Kategori</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('kategori.destroy','test')}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                        <p class="text-center">
                                            Are you sure you want to delete this?
                                        </p>
                                        <input type="hidden" id="kode_kategori" name="kode_kategori" value="">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                                            <button type="submit" class="btn btn-warning">Yes, Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Merk --}}
                                <div class="modal fade" id="ModalMerk" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="largeModalLabel">Tambahkan Merk Baru</h5>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{action('TbMerekController@store')}}" method="post" class="">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label for="nf-email" class=" form-control-label">Nama Merk</label>
                                                        <input type="text" id="nf-email" name="nama_merek" placeholder="Masukkan nama merk.." class="form-control">
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

                    {{-- Modal update merk --}}
                    <div class="modal fade" id="editMerk" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="largeModalLabel">Edit Merk</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('merk.update','test')}}" method="post" class="">
                                        {{method_field('patch')}}
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="kode_merek" class=" form-control-label">Nama Merk</label>
                                            <input type="hidden" id="kode_merek" name="kode_merek" value="">
                                            <input type="text" id="nama_merek" name="nama_merek" class="form-control">
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

                    {{-- Modal delete merk --}}
                    <div class="modal fade" id="deleteMerk" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="largeModalLabel">Hapus Merk</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('merk.destroy','test')}}" method="post">
                                            {{method_field('delete')}}
                                            {{csrf_field()}}
                                            <p class="text-center">
                                                Are you sure you want to delete this?
                                            </p>
                                            <input type="hidden" id="kode_merek" name="kode_merek" value="">

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                                                <button type="submit" class="btn btn-warning">Yes, Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Vendor --}}
                        <div class="modal fade" id="ModalVendor" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="largeModalLabel">Tambahkan Vendor Baru</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{action('TbVendorController@store')}}" method="post" class="">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="nf-email" class=" form-control-label">Nama Vendor</label>
                                                <input type="text" id="nf-email" name="nama_vendor" placeholder="Masukkan nama vendor.." class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="nf-email" class=" form-control-label">Alamat Vendor</label>
                                                <input type="text" id="nf-email" name="alamat" placeholder="Masukkan alamat.." class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="nf-email" class=" form-control-label">No HP</label>
                                                <input type="text" id="nf-email" name="no_telp" placeholder="Masukkan no. telp.." class="form-control">
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

                        {{-- Modal update vendor --}}
                        <div class="modal fade" id="editVendor" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="largeModalLabel">Edit Vendor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('datavendor.update','test')}}" method="post" class="">
                                            {{method_field('patch')}}
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="kode_vendor" class=" form-control-label">Nama Vendor</label>
                                                <input type="hidden" id="kode_vendor" name="kode_vendor" value="">
                                                <input type="text" id="nama_vendor" name="nama_vendor" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="kode_vendor" class=" form-control-label">Alamat</label>
                                                <input type="hidden" id="kode_vendor" name="kode_vendor" value="">
                                                <input type="text" id="alamat" name="alamat" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="kode_vendor" class=" form-control-label">No Telp</label>
                                                <input type="hidden" id="kode_vendor" name="kode_vendor" value="">
                                                <input type="text" id="no_telp" name="no_telp" class="form-control">
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

                        {{-- Modal delete vendor --}}
                        <div class="modal fade" id="deleteVendor" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="largeModalLabel">Hapus Vendor</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('datavendor.destroy','test')}}" method="post">
                                                {{method_field('delete')}}
                                                {{csrf_field()}}
                                                <p class="text-center">
                                                    Are you sure you want to delete this?
                                                </p>
                                                <input type="hidden" id="kode_vendor" name="kode_vendor" value="">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                                                    <button type="submit" class="btn btn-warning">Yes, Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          {{-- Modal outlet --}}
                          <div class="modal fade" id="ModalOutlet" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="largeModalLabel">Tambahkan Outlet Baru</h5>
                                      </div>
                                      <div class="modal-body">
                                          <form action="{{action('TbOutletController@store')}}" method="post" class="">
                                              {{ csrf_field() }}
                                              <div class="form-group">
                                                  <label for="nf-email" class=" form-control-label">Kode Outlet</label>
                                                  <input type="text" id="nf-email" name="kode_outlet" placeholder="Masukkan kode outlet.." class="form-control">
                                              </div>
                                              <div class="form-group">
                                                  <label for="nf-email" class=" form-control-label">Nama Outlet</label>
                                                  <input type="text" id="nf-email" name="nama_outlet" placeholder="Masukkan nama outlet.." class="form-control">
                                              </div>
                                              <div class="form-group">
                                                  <label for="nf-email" class=" form-control-label">Alamat Outlet</label>
                                                  <input type="text" id="nf-email" name="alamat" placeholder="Masukkan alamat.." class="form-control">
                                              </div>
                                              <div class="form-group">
                                                  <label for="nf-email" class=" form-control-label">No HP</label>
                                                  <input type="text" id="nf-email" name="no_telp" placeholder="Masukkan no. telp.." class="form-control">
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

                          {{-- Modal update outlet --}}
                          <div class="modal fade" id="editOutlet" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="largeModalLabel">Edit Outlet</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <form action="{{route('outlet.update','test')}}" method="post" class="">
                                              {{method_field('patch')}}
                                              {{ csrf_field() }}
                                              <div class="form-group">
                                                  <label for="kode_outlet" class=" form-control-label">Kode Outlet</label>
                                                  <input type="hidden" id="kode_outlet" name="kode_outlet" value="">
                                                  <input type="text" id="kode_outlet" name="kode_outlet" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                  <label for="nama_outlet" class=" form-control-label">Nama Outlet</label>
                                                  <input type="text" id="nama_outlet" name="nama_outlet" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                  <label for="alamat_outlet" class=" form-control-label">Alamat</label>
                                                  <input type="text" id="alamat" name="alamat" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                  <label for="no_outlet" class=" form-control-label">No Telp</label>
                                                  <input type="text" id="no_telp" name="no_telp" class="form-control">
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

                          {{-- Modal delete outlet --}}
                          <div class="modal fade" id="deleteOutlet" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="largeModalLabel">Hapus Outlet</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                              <form action="{{route('outlet.destroy','test')}}" method="post">
                                                  {{method_field('delete')}}
                                                  {{csrf_field()}}
                                                  <p class="text-center">
                                                      Are you sure you want to delete this?
                                                  </p>
                                                  <input type="hidden" id="kode_outlet" name="kode_outlet" value="">
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                                                      <button type="submit" class="btn btn-warning">Yes, Delete</button>
                                                  </div>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>




  <!-- end: page -->
</section>
@endsection
