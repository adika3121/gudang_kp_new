@extends('layout.layout')

@section('title')
  Transaksi Barang Masuk
@endsection

@section('transaksi')
  nav-active
@endsection

@section('content')
<!-- Section Main Content Tempat isinya berada  -->
<section role="main" class="content-body">
  <header class="page-header">
    <h2>Transaksi Barang</h2>

    <div class="right-wrapper pull-right">
      <ol class="breadcrumbs">
        <li>
          <a href="index.html">
            <i class="fa fa-home"></i>
          </a>
        </li>
        <li><span>Transaksi Barang</span></li>
      </ol>

      <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
  </header>

  <!-- start: page -->
    <form id="form" action="{{action('TbTransaksiController@store')}}" method="post" class="snTransaksi">
      <section class="panel">
        @if ($errors->any())
          @if($errors->first('success'))
          <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong> {{ $errors->first('success') }} </strong>
          </div>
          @endif
        @endif
        <header class="panel-heading">
          <h2 class="panel-title">Tambah Transaksi Barang</h2>
        </header>

        <div class="panel-body">
          {{ csrf_field() }}
          <!-- Data dari View sebelumnya di hide -->
          <input type="hidden" name="nama_outlet" value="{{$nama_outlet}}">
          <input type="hidden" name="kode_master" value="{{$kode_master}}">
          <input type="hidden" name="id_master" value="{{$id_master}}">
          <input type="hidden" name="vendor" value="{{$vendor}}">

          <!-- Nama barang -->
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Nama Barang</label>
              </div>
              <div class="col-12 col-md-9">
                <input type="text" name="nama_barang" value="{{$nama_lainnya->nama_barang}}" class="form-control" disabled>

                  <!-- <textarea id="kode_pn" name="keterangan" placeholder="..." value="" class="form-control"></textarea> -->
              </div>
          </div>

          <!-- nama outlet -->
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Nama Outlet</label>
              </div>
              <div class="col-12 col-md-9">
                <input type="text" name="name_out" value="{{$nama_lainnya->nama_outlet}}" class="form-control" disabled>

                  <!-- <textarea id="kode_pn" name="keterangan" placeholder="..." value="" class="form-control"></textarea> -->
              </div>
          </div>

          <!-- Nama vendor -->
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Nama Vendor</label>
              </div>
              <div class="col-12 col-md-9">
                <input type="text" name="nama_vendor" value="{{$nama_vendor->nama}}" class="form-control" disabled>

                  <!-- <textarea id="kode_pn" name="keterangan" placeholder="..." value="" class="form-control"></textarea> -->
              </div>
          </div>

          <!-- Form Mengisi Catatn dan SN -->
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Catatan</label>
              </div>
              <div class="col-12 col-md-9">
                  @if(!empty($ket) > 0)
                      <input type="text" name="keterangan" value="{{ $ket }}" class="form-control">
                  @else
                      <input type="text" name="keterangan" value="" class="form-control">
                  @endif

                  <!-- <textarea id="kode_pn" name="keterangan" placeholder="..." value="" class="form-control"></textarea> -->
              </div>
          </div>
          <div class="row form-group">
              <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Kode SN <span class="required">*</span></label>
              </div>
              <div class="col-12 col-md-9">
                  <input type="text" id="sn" name="sn" placeholder="SN" class="form-control" autofocus>
                  @if ($errors->any())
                    @if($errors->first('sn'))
                    <div class="alert alert-warning">
                      <li>{{ $errors->first('sn') }}</li>
                    </div>
                    @endif
                  @endif
                </td>
                <td><input type="text" class="form-control" id="keterangan" name="keterangan[]" value="{{$keterangan}}" ></td>
                <td><button type="button" name="remove" id="'firstremove'" class="btn btn-danger btn_removefirst">X</button></td>
            </tr>
          </tbody>
        </table>
      
        {{-- <section class="panel">
          <header class="panel-heading">
            <h2 class="panel-title">Tambah Transaksi Barang</h2>
          </header>
          <div class="panel-body"> --}}
            

            <!-- Form Mengisi Catatn dan SN -->
            {{-- <div class="row form-group">
                <div class="col col-md-3">
                    <label for="text-input" class=" form-control-label">Catatan</label>
                </div>
                <div class="col-12 col-md-9">
                    <textarea id="kode_pn" name="keterangan" placeholder="..." class="form-control"></textarea>
                </div>
            </div> --}}
        <div class="row form-group"> 
                {{-- <div class="col col-md-3">
                    <label for="text-input" class=" form-control-label">Kode SN <span class="required">*</span></label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" id="sn" name="sn" placeholder="SN" class="form-control">
                    @if ($errors->any())
                      @if($errors->first('sn'))
                      <div class="alert alert-warning">
                        <li>{{ $errors->first('sn') }}</li>
                      </div>
                      @endif
                      @endif
                </div> --}}
        </div>
        <!-- Button Tambah Transaksi SN -->
            <div class="row">
              <div class="col-sm-6">
                <div class="mb-md">
                  <button data-toggle="modal" data-target="#tambahTransaksi" class="btn btn-success">Simpan</button>
                </div>
              </div>
          </div>
          <!-- Button Tambah Transaksi SN -->
          <div class="row">
  					<div class="col-sm-6">
  						<div class="mb-md">
  							<button data-toggle="modal" data-target="#tambahTransaksi" class="btn btn-primary">Tambah Transaksi Masuk <i class="fa fa-plus"></i></button>
                <a href="/transaksi" class="btn btn-warning">Kembali ke Tabel Transaksi</a>
  						</div>
  					</div>
  				</div>
          <!--  -->
        </form>


      </div>  <!-- div panel body -->
    </section> <!-- section panel-->
  <!-- end: page -->
</section>
@endsection

@section('script_transaksi')
  <script>

  </script>
@endsection
