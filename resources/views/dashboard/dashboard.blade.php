@extends('layout.layout')

@section('title')
  Dashboard Gudang
@endsection

@section('dashboard')
  nav-active
@endsection

@section('content')
<!-- Section Main Content Tempat isinya berada  -->
<section role="main" class="content-body">
  <header class="page-header">
    <h2>Dashboard</h2>

    <div class="right-wrapper pull-right">
      <ol class="breadcrumbs">
        <li>
          <a href="index.html">
            <i class="fa fa-home"></i>
          </a>
        </li>
        <li><span>Dashboard</span></li>
      </ol>

      <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
  </header>

  <!-- start: page -->
  <div class="row">
    <div class="col-md-6">
        <section class="panel">
          <header class="panel-heading">
            <div class="panel-actions">
              <a href="#" class="fa fa-caret-down"></a>
            </div>

            <h2 class="panel-title">Data Stock Sebuah Outlet</h2>

          </header>
          <div class="panel-body">
          {{-- Data Kategori --}}
          <div class="card" style="center">
              <div class="card-header">
              </div>
              <form action="{{action('dashboardController@lihat_stock_outlet')}}" method="post" class="">
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
          <footer class="panel-footer">
            <div class="row">
              <div class="center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <button type="submit" class="btn btn-primary">Lanjut</button>
              </div>
            </div>
          </form>
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

              <h2 class="panel-title">Stock Masuk Terbaru Sebuah Outlet</h2>
            </header>
            <div class="panel-body">
            {{-- Data Merk --}}
            <div class="card" style="center">
                <div class="card-header">
                </div>
                <form action="{{action('dashboardController@lihat_stock_masuk_terbaru')}}" method="post" class="">
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
            <footer class="panel-footer">
              <div class="row">
                <div class="center">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                  <button type="submit" class="btn btn-primary">Lanjut</button>
                </div>
              </div>
              </form>
            </footer>
          </section>
      </div>
      <!-- end merk  -->
    </div>
  <!-- end: page -->
</section>
@endsection
