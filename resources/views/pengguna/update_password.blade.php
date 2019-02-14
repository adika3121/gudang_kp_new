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
          <div class="col-md-12">
              <section class="panel">
                <header class="panel-heading">
                  <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                  </div>

                  <h2 class="panel-title">Ganti Password {{$nama_pengguna}}</h2>

                </header>
                <div class="panel-body">
                  <form class="" action="{{action('penggunaController@update_pass')}}" method="post">
                    {{method_field('patch')}}
                    {{ csrf_field() }}
                    <input type="hidden" name="id_user" value="{{$id_user}}">
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
                  </form>
                </div>
                <footer class="panel-footer">
                  <div class="row">
                    <div class="center">
                      <button type="submit" class="btn btn-primary">
                          {{ __('Ganti Password ') }}
                      </button>
                      </form>
                    </div>
                  </div>
                </footer>
              </section>
            </form>
          </div>
          <!-- end kategori  -->


          </div> <!-- End DIV ROW view-->





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
