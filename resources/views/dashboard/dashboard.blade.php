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
    <div class="col-md-12">
      <section class="panel">
        <header class="panel-heading">
          <div class="panel-actions">
              <a href="#" class="fa fa-caret-down"></a>
          </div>

          <h2 class="panel-title">Sisa Stock Berdasarkan Kategori</h2>
        </header>
        <div class="panel-body">
        {{-- Data Merk --}}
        <div class="card" style="center">
            <div class="card-header">
            </div>
            <form action="{{action('dashboardController@lihat_stock_based_type')}}" method="post" class="">
            <div class="card-body card-block">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="outlet" class=" form-control-label">Pilih Kategori</label>
                        <select class="form-control" name="kategori">
                          <@if(count($tb_kategori->all()) > 0)
                              @foreach($tb_kategori->all() as $kategori)
                                  <option value="{{$kategori->kode_kategori}}">{{$kategori->nama_kategori}}</option>
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
              <button type="submit" class="btn btn-primary">Lanjut</button>
            </div>
          </div>
          </form>
        </footer>
      </section>
    </div>
  </div>

  <!-- div row pertama -->
  <div class="row">
    <!-- Stock Masuk Terbaru Sebuah Outlet -->
      <div class="col-md-6">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                  <a href="#" class="fa fa-caret-down"></a>
              </div>

              <h2 class="panel-title">Stock Masuk Outlet</h2>
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
                  <button type="submit" class="btn btn-primary">Lanjut</button>
                </div>
              </div>
              </form>
            </footer>
          </section>
      </div>
      <!-- end stock masuk outlet -->
      <!-- Stock Sebuah Outlet -->
    <div class="col-md-6">
        <section class="panel">
          <header class="panel-heading">
            <div class="panel-actions">
              <a href="#" class="fa fa-caret-down"></a>
            </div>

            <h2 class="panel-title">Stock Keluar Outlet</h2>

          </header>
          <div class="panel-body">
          {{-- Data Kategori --}}
          <div class="card" style="center">
              <div class="card-header">
              </div>
              <form action="{{action('dashboardController@lihat_stock_keluar_terbaru')}}" method="post" class="">
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
                <button type="submit" class="btn btn-primary">Lanjut</button>
              </div>
            </div>
          </form>
          </footer>
        </section>
      </form>
    </div>
    <!-- end Stock Outlet  -->

    </div><!-- div row pertama -->

    <!-- Stock Keluar Sebuah Outlet -->
    <div class="row">
      <div class="col-md-12">
        <section class="panel">
          <header class="panel-heading">
            <div class="panel-actions">
              <a href="#" class="fa fa-caret-down"></a>
            </div>

            <h2 class="panel-title">Data Stock Outlet</h2>

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
                <button type="submit" class="btn btn-primary">Lanjut</button>
              </div>
            </div>
          </form>
          </footer>
        </section>
      </form>
      </div>
      <!-- end Stock Keluar -->
    </div> <!-- div row kedua -->
  <!-- end: page -->
</section>
@endsection
