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
            <h2>404</h2>
        
            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span>Pages</span></li>
                    <li><span>404</span></li>
                </ol>
        
                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>

        <!-- start: page -->
            <section class="body-error error-inside">
                <div class="center-error">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="main-error mb-xlg">
                                <h2 class="error-code text-dark text-center text-semibold m-none">404 <i class="fa fa-file"></i></h2>
                                <p class="error-explanation text-center">Sorry, you can't access this page. </p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
        <!-- end: page -->
    </section>
@endsection

