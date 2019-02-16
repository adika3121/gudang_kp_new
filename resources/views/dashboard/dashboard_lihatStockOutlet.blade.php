@extends('layout.layout')

@section('title')
  Dashboard Gudang | Lihat Stock {{$nama_outlet->nama}}
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

            <h2 class="panel-title">Data Stock Outlet {{$nama_outlet->nama}} </h2>

          </header>
          <div class="panel-body">
          <!-- Tampilan Stock Sebuah Outlet -->
            <div class="table-responsive table--no-card m-b-30">
              <table class="table table-borderless table-striped table-earning" id="datatable-default">
                <thead>
                  <tr>
                    <th>Nama Barang</th>
                    <th>Stock Masuk</th>
                    <th>Stock Keluar</th>
                    <th>Sisa Stock</th>
                    <th>Lainnya</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($lihat_stock as $stock)
                  <tr>
                    <td>{{$stock->nama_barang}}</td>
                    <td>{{$stock->stock_masuk}}</td>
                    <td>{{$stock->stock_keluar}}</td>
                    <td>{{$stock->sisa_stock}}</td>
                    <td><form class="" action="{{action('dashboardController@lihat_detail_stock')}}" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="kode_master" value="{{$stock->kode_master}}">
                      <button type="submit" class="btn btn-primary">Lihat Detail</button>
                    </form></td>
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
    <!-- end stock outlet  -->


    </div>
  <!-- end: page -->
</section>
@endsection

@section('script_lihat_stock_outlet')
<script>
      $(function() {
          $('#lihatStockTable').DataTable({
              scrollX : true,
              scrollCollapse : true,
              "autoWidth": false
          });
      });
</script>
@endsection
