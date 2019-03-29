@extends('layout.layout')

@section('title')
  Dashboard Gudang | Stock Masuk
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

            <h2 class="panel-title">Data Sisa Stock {{$nama_dan_outlet_barang->nama_barang}} pada {{$nama_dan_outlet_barang->nama_outlet}}</h2>

          </header>
          <div class="panel-body">
          <!-- Tampilan Stock Keluar Sebuah Outlet -->
            <div class="table-responsive table--no-card m-b-30">
              <table class="table table-borderless table-striped table-earning" id="datatable-default">
                <thead>
                  <tr>
                    <th>Kode SN</th>
                    <th>Waktu Masuk</th>
                    <th>Catatan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($sisa_stock as $stk_sisa)
                    <tr>
                      <td>{{$stk_sisa->sn}}</td>
                      <td>{{$stk_sisa->waktu_masuk}}</td>
                      <td>{{$stk_sisa->catatan}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <footer class="panel-footer">
            <div class="row">
              <div class="center">
                <form class="" action="{{action('dashboardController@get_excell_sisa_stock')}}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="kode_master" value="{{$kode_master}}">
                  <button type="submit" name="button" class="btn btn-primary">Export to Excell</button>
                </form>
              </div>
            </div>
          </footer>
        </section>
      </form>
    </div>


  </div>
  <!-- End Sisa Stock -->
  <div class="row">
    <div class="col-md-12">
        <section class="panel">
          <header class="panel-heading">
            <div class="panel-actions">
              <a href="#" class="fa fa-caret-down"></a>
            </div>

            <h2 class="panel-title">Data Stock Masuk {{$nama_dan_outlet_barang->nama_barang}} pada {{$nama_dan_outlet_barang->nama_outlet}}</h2>

          </header>
          <div class="panel-body">
          <!-- Tampilan Stock Masuk Sebuah Outlet -->
            <div class="table-responsive table--no-card m-b-30">
              <table class="table table-borderless table-striped table-earning" id="outletTable">
                <thead>
                  <tr>
                    <th>Kode SN</th>
                    <th>Waktu Masuk</th>
                    <th>Catatan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($transaksi as $trans)
                    <tr>
                      <td>{{$trans->sn}}</td>
                      <td>{{$trans->waktu_masuk}}</td>
                      <td>{{$trans->catatan}}</td>
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
  </div>
    <!-- end stock masuk terbaru  -->

    <div class="row">
      <div class="col-md-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
              </div>

              <h2 class="panel-title">Data Stock Keluar {{$nama_dan_outlet_barang->nama_barang}} pada {{$nama_dan_outlet_barang->nama_outlet}}</h2>

            </header>
            <div class="panel-body">
            <!-- Tampilan Stock Keluar Sebuah Outlet -->
              <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning" id="stockTable">
                  <thead>
                    <tr>
                      <th>Kode SN</th>
                      <th>Waktu Keluar</th>
                      <th>Catatan</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($stock_keluar as $stk_kluar)
                      <tr>
                        <td>{{$stk_kluar->sn}}</td>
                        <td>{{$stk_kluar->waktu_keluar}}</td>
                        <td>{{$stk_kluar->catatan}}</td>
                        <td>{{$status_jadi[$stk_kluar->status]}}</td>
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


    </div>
  <!-- end: page -->
</section>
@endsection
