@extends('layout.layout-marketing')

@section('title')
  Dashboard Gudang | Stock Keluar {{$nama_outlet->nama}}
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

            <h2 class="panel-title">Data Stock Keluar {{$nama_outlet->nama}} </h2>

          </header>
          <div class="panel-body">
          <!-- Tampilan Stock Keluar Sebuah Outlet -->
            <div class="table-responsive table--no-card m-b-30">
              <table class="table table-borderless table-striped table-earning" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                <thead>
                  <tr>
                    <th>Nama Barang</th>
                    <th>Kode SN</th>
                    <th>Waktu Masuk</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($lihat_stock as $stock)
                  <tr>
                    <td>{{$stock->nama_barang}}</td>
                    <td>{{$stock->kode_sn}}</td>
                    <td>{{$stock->waktu_masuk}}</td>
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
    <!-- end Stock Keluar  -->


    </div>
  <!-- end: page -->
</section>
@endsection
