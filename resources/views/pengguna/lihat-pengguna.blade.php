@extends('layout.layout')

@section('title')
  Tambah Pengguna Baru
@endsection

@section('Tambah Pengguna')
  nav-active
@endsection

@section('content')
<!-- Section Main Content Tempat isinya berada  -->
<section role="main" class="content-body">
  <header class="page-header">
    <h2>Pengguna Sistem Gudang Baliyoni</h2>

    <div class="right-wrapper pull-right">
      <ol class="breadcrumbs">
        <li>
          <a href="/pengguna">
            <i class="fa fa-home"></i>
          </a>
        </li>
        <li><span>Pengguna Sistem Gudang Baliyoni</span></li>
      </ol>
      <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
  </header>
  <!-- start: page -->
  <!-- Tampilan Kategori  -->
        <div class="row">
          <div class="col-md-7">
              <section class="panel">
                <header class="panel-heading">
                  <div class="panel-actions">
                    <button class="btn btn-primary"data-toggle="modal" data-target="#ModalPengguna">+ Tambah Pengguna</button>
                    <a href="#" class="fa fa-caret-down"></a>
                  </div>

                  <h2 class="panel-title">Pengguna Sistem Gudang</h2>

                </header>
                <div class="panel-body">
                {{-- Data Pengguna --}}
                <div class="table-responsive table--no-card m-b-30 table-wrapper-scroll-y">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>Nama Pengguna</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                            <tbody>
                                 @foreach($tampilUser as $tp_user)
                                <tr>
                                    <td>{{$tp_user->name}}</td>
                                    <td>{{$tp_user->email}}</td>
                                    <td>{{$tp_user->role}}</td>
                                    <td style="float:right;">
                                        <button class="btn btn-outline-warning" data-toggle="modal"
                                        data-target="#editPengguna"
                                        data-id="{{$tp_user->id}}"
                                        data-name="{{$tp_user->name}}"
                                        data-email="{{$tp_user->email}}"
                                        data-role="{{$tp_user->role}}"><i class="fa fa-edit"></i></button>

                                        <button class="btn btn-danger"
                                        data-toggle="modal"
                                        data-target="#deletePengguna"
                                        data-id="{{$tp_user->id}}"
                                        ><i class="fa fa-trash-o"></i></button>
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

                    </div>
                  </div>
                </footer>
              </section>
            </form>
          </div>
          <!-- end kategori  -->

          <!-- Tampilan Merk -->
            <div class="col-md-5">
                <section class="panel">
                  <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>

                    <h2 class="panel-title">Penjelasan Tipe Pengguna</h2>
                  </header>

                  <div class="panel-body">
                    <p>Terdapat 4 jenis pengguna. Diantaranya adalah sebagai berikut</p>
                    <div class="row">
                      <div class="col-md-12">
                        <ul>
                          <!-- Admin -->
                          <li>Admin</li>
                          Admin dapat mengakses beberapa fungsi berikut
                          <ul>
                            <li>Dashboard</li>
                            <li>Master Barang</li>
                            <li>Transaksi</li>
                            <li>Stock Keluar</li>
                            <li>Lainnya</li>
                            <li>Pengguna Sistem</li>
                          </ul> <br>

                          <!-- Marketing -->
                          <li>Marketing</li>
                          Marketing dapat mengakses beberapa fungsi berikut
                          <ul>
                            <li>Dashboard</li>
                          </ul> <br>

                          <!-- Pengiriman -->
                          <li>Pengiriman</li>
                          Pengiriman dapat mengakses beberapa fungsi berikut
                          <ul>
                            <li>Master Barang</li>
                            <li>Stock Keluar</li>
                          </ul><br>

                          <!-- Gudang -->
                          <li>Gudang</li>
                          Gudang dapat mengakses beberapa fungsi berikut
                          <ul>
                            <li>Master Barang</li>
                            <li>Transaksi</li>
                          </ul>
                        </ul>

                      </div>
                    </div>

                  </div>

                  <footer class="panel-footer">
                    <div class="row">
                      <div class="center">

                      </div>
                    </div>
                  </footer>
                </section>
            </div>
            <!-- end merk  -->
          </div> <!-- End DIV ROW view-->

          <!-- Kumpulan Modal -->
          {{-- Modal Tambah Pengguna --}}
          <div class="modal fade" id="ModalPengguna" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="largeModalLabel">Tambahkan Pengguna Baru</h5>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ route('pengguna.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" >

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Tipe Pengguna') }}</label>

                                <div class="col-md-6">
                                  <select class="form-control" name="role" id="role">
                                      <option value="admin">admin</option>
                                      <option value="marketing">marketing</option>
                                      <option value="pengiriman">pengiriman</option>
                                      <option value="gudang">gudang</option>
                                  </select>

                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="confirm_pass" type="password" class="form-control" name="confirm_pass" >

                                    @if ($errors->has('confirm_pass'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('confirm_pass') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                      </div>
                  </div>
              </div>
          </div>
            {{-- Modal update pengguna --}}
            <div class="modal fade" id="editPengguna" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="largeModalLabel">Edit Pengguna</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('pengguna.update','test')}}" method="post" class="">
                                {{method_field('patch')}}
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="nama_kategori" class=" form-control-label">Nama Pengguna</label>
                                    <input type="hidden" id="id_pengguna_update" name="id_pengguna_update" value="{{old('id_pengguna_update')}}">
                                    <input type="text" id="nama_pengguna_update" name="nama_pengguna_update" class="form-control" value="{{ old('nama_pengguna_update') }}">
                                    @if ($errors->any())
                                        @if($errors->first('nama_pengguna_update'))
                                        <div class="alert alert-warning">
                                          <li>{{ $errors->first('nama_pengguna_update') }}</li>
                                        </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email_pengguna_update" class=" form-control-label">Email Pengguna</label>
                                    <input type="text" id="email_pengguna_update" name="email_pengguna_update" class="form-control" value="{{ old('email_pengguna_update') }}">
                                    @if ($errors->any())
                                        @if($errors->first('email_pengguna_update'))
                                        <div class="alert alert-warning">
                                          <li>{{ $errors->first('email_pengguna_update') }}</li>
                                        </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="role_pengguna_update" class=" form-control-label">Tipe Pengguna</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="role_pengguna_update" id="role_pengguna_update" class="form-control">
                                          <option value="admin">admin</option>
                                          <option value="marketing">marketing</option>
                                          <option value="pengiriman">pengiriman</option>
                                          <option value="gudang">gudang</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <form class="" action="{{action('penggunaController@ganti_password')}}" method="post">
                                      <input type="hidden" id="id_pengguna_update" name="id_pengguna_update" value="{{old('id_pengguna_update')}}">
                                      <button type="submit" class="btn btn-primary btn-sm" name="button">Ganti Password Baru</button>
                                    </form>
                                </div> -->
                                <div class="modal-footer" style="padding-left:0px;">
                                    <div class="row">
                                      <div class="col-md-2" style="text-align:left;">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Simpan
                                        </button>
                                        </form>
                                      </div>
                                      <div class="col-md-10">
                                        <form class="" action="{{route('pengguna-pass.ganti_password')}}" method="post" id="form_ganti_password">
                                          {{ csrf_field() }}
                                          <input type="hidden" id="id_pengguna_update" name="id_pengguna_update" value="{{old('id_pengguna_update')}}">
                                          <button type="submit" class="btn btn-warning btn-sm" name="button">Ganti Password Baru</button>
                                        </form>
                                      </div>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal delete kategori --}}
            <div class="modal fade" id="deletePengguna" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="largeModalLabel">Hapus Pengguna</h5>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('pengguna.destroy','test')}}" method="post">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                    <p class="text-center">
                                        Yakin ingin menghapus pengguna ini?
                                    </p>
                                    <input type="hidden" id="id" name="id" value="">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Tidak, Batalkan</button>
                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



</section>
@endsection

@section('script_pengguna')
  <script>
  //////// Tambah Pengguna
  @if ($errors->any())
    @if($errors->first('name'))
      $('#ModalPengguna').modal('show');
    @endif
  @endif
  @if ($errors->any())
    @if($errors->first('email'))
      $('#ModalPengguna').modal('show');
    @endif
  @endif
  @if ($errors->any())
    @if($errors->first('role'))
      $('#ModalPengguna').modal('show');
    @endif
  @endif
  @if ($errors->any())
    @if($errors->first('password'))
      $('#ModalPengguna').modal('show');
    @endif
  @endif
  @if ($errors->any())
    @if($errors->first('confirm_pass'))
      $('#ModalPengguna').modal('show');
    @endif
  @endif
  /////////////////////////

  /////// Update Pengguna

  @if ($errors->any())
    @if($errors->first('id_outlet_update'))
      $('#editPengguna').modal('show');
    @endif
  @endif

  @if ($errors->any())
    @if($errors->first('nama_pengguna_update'))
      $('#editPengguna').modal('show');
    @endif
  @endif

  @if ($errors->any())
    @if($errors->first('email_pengguna_update'))
      $('#editPengguna').modal('show');
    @endif
  @endif


  @if ($errors->any())
    @if($errors->first('role_pengguna_update'))
      $('#editPengguna').modal('show');
    @endif
  @endif


  /////////////////////////////////////////////
      $('#editPengguna').on('show.bs.modal', function (event) {

          var button = $(event.relatedTarget)
          var nama_pengguna = button.data('name')
          var email = button.data('email')
          var role = button.data('role')
          var id_pengguna = button.data('id')
          var modal = $(this)

          modal.find('.modal-body #nama_pengguna_update').val(nama_pengguna);
          modal.find('.modal-body #id_pengguna_update').val(id_pengguna);
          modal.find('.modal-body #email_pengguna_update').val(email);
          modal.find('.modal-body #role_pengguna_update').val(role);
      })

      $('#deletePengguna').on('show.bs.modal', function (event) {

          var button = $(event.relatedTarget)
          var id_pengguna = button.data('id')
          var modal = $(this)

          modal.find('.modal-body #id').val(id_pengguna);
      })
  </script>
@endsection
