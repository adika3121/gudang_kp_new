@extends('layout.layout')

@section('title')
  Data Lainnya
@endsection

@section('lainnya')
  nav-active
@endsection

@section('content')
<!-- Section Main Content Tempat isinya berada  -->
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Transaksi</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
                </li>
                <li><span>Transaksi</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div style="width:100%;">
            <form>
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                            <a href="#" class="fa fa-times"></a>
                        </div>

                        <h2 class="panel-title">Tambah Transaksi</h2>
                    </header>

                        <div class="panel-body">
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <input type="text" name="firstName" placeholder="First Name" class="form-control">
                                </div>

                                <div class="mb-md hidden-lg hidden-xl"></div>

                                <div class="col-lg-4">
                                    <input type="email" name="lastName" placeholder="Last Name" class="form-control">
                                </div>

                                <div class="mb-md hidden-lg hidden-xl"></div>

                                <div class="col-lg-4">
                                    <input type="email" name="email" placeholder="Your Email" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <textarea class="form-control" rows="5" placeholder="Type your message"></textarea>
                                </div>
                            </div>
                        </div>
                        <footer class="panel-footer">
                            <button class="btn btn-primary">Add Comment</button>
                        </footer>
                </section>
            </form>
        </div>



    <!-- end: page -->
</section>

@endsection

