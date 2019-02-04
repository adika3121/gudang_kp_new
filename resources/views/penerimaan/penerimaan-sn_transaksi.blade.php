@extends('layout.layout-penerimaan')

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
  <section class="panel">
    <header class="panel-heading">
      <div class="panel-actions">
        <button class="btn btn-primary" type="button" name="add" id="add">+ Add more</button>
      </div>
      <h2 class="panel-title">Tambah Transaksi</h2>
    </header>
    <div class="panel-body">
      <form name="add_sn" id="add_sn" action="{{action('PenerimaanTransaksiController@store')}}" method="post" class="snTransaksi" onkeypress="return event.keyCode != 13;">
        {{ csrf_field() }}
        <!-- Data dari View sebelumnya di hide -->
        <input type="hidden" name="nama_outlet" value="{{$nama_outlet}}">
        <input type="hidden" name="kode_master" value="{{$kode_master}}">
        <input type="hidden" name="id_master" value="{{$id_master}}">
        <input type="hidden" name="vendor" value="{{$vendor}}">
        <input type="hidden" name="keterangan" value="{{$keterangan}}">
        <table class="table table-bordered table-striped mb-none" id="dynamic_field">
          <thead>
            <tr>
              <th><strong>Kode Master</strong></th>
              <th><strong>Outlet</strong></th>
              <th><strong>Vendor</strong></th>
              <th><strong>Kode SN</strong></th>
              <th><strong>Catatan</strong></th>
              <th><strong></strong></th>
            </tr>
          </thead>
          <tbody>
            <tr id="tablerow">
                <td>{{$kode_master}}</td>
                <td>{{$nama_outlet}}</td>
                <td>{{$nama_vendor->nama_vendor}}</td>
                <td><div class="col-12 col-md-9">
                      <input type="text" class="form-control" id="sn" name="sn[]" placeholder="SN" >
                      @if ($errors->any())
                        @if($errors->first('sn'))
                          <div class="alert alert-warning">
                            <li>{{ $errors->first('sn') }}</li>
                          </div>
                        @endif
                      @endif
                    </div>
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
            <!--  -->
          </form>


        </div>  <!-- div panel body -->
    </section> <!-- section panel-->
  <!-- end: page -->
</section>
@endsection
@section('script_addmore')
<script>
  document.addEventListener('keyup', function(event) {
        event.preventDefault();
        var target = event.target || event.srcElement,
            text = target.value;
        if (event.keyCode === 13) {
            document.getElementById("add").click();
        }
    }, false);

    $(".btn_removefirst").click(function(){
      $('#tablerow').remove();
    });
</script>
<script type="text/javascript">
  
  $(document).ready(function(){      
    var postURL = "<?php echo url('addmore'); ?>";
    var i=1;  


    $('#add').click(function(){  
       i++;  
       $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td>{{$kode_master}}</td><td>{{$nama_outlet}}</td><td>{{$nama_vendor->nama_vendor}}</td><td><div class="col-12 col-md-9"><input type="text" class="form-control sn" id="serial" name="sn[]" placeholder="SN">@if ($errors->any()) @if($errors->first('sn')) <div class="alert alert-warning"><li>{{ $errors->first('sn') }}</li></div>@endif @endif</div></td><td><input type="text" class="form-control" id="keterangan" name="keterangan[]" value="{{$keterangan}}" ></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
       $( ".sn" ).focus();   
    });

    $(document).on('click', '.btn_remove', function(){  
       var button_id = $(this).attr("id");   
       $('#row'+button_id+'').remove();  
    });
    
    
    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    $('#submit').click(function(){            
       $.ajax({  
        url:postURL,  
        method:"POST",  
        data:$('#add_sn').serialize(),
        type:'json',
        success:function(data)  
        {
          if(data.error){
            printErrorMsg(data.error);
          }else{
            i=1;
            $('.dynamic-added').remove();
            $('#add_sn')[0].reset();
            $(".print-success-msg").find("ul").html('');
            $(".print-success-msg").css('display','block');
            $(".print-error-msg").css('display','none');
            $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
          }
        }  
       });  
    });  


    function printErrorMsg (msg) {
     $(".print-error-msg").find("ul").html('');
     $(".print-error-msg").css('display','block');
     $(".print-success-msg").css('display','none');
     $.each( msg, function( key, value ) {
      $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
     });
    }
  });  
</script>
@endsection
