<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Gudang Baliyoni | @yield('title')</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<link rel="shortcut icon" href="{{asset('assets/images/baliyoni3.png')}}">

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/magnific-popup/magnific-popup.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-datepicker/css/datepicker3.css')}}" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="{{asset('assets/vendor/select2/select2.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/vendor/jquery-datatables-bs3/assets/css/datatables.css')}}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{asset('assets/stylesheets/theme.css')}}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{asset('assets/stylesheets/skins/default.css')}}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{asset('assets/stylesheets/theme-custom.css')}}">

		<!-- Head Libs -->
		<script src="{{asset('assets/vendor/modernizr/modernizr.js')}}"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
						<img src="{{asset('assets/images/by.jpg')}}" height="35" alt="Porto Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>

				<!-- start: search & user box -->
				<div class="header-right">

					<span class="separator"></span>

					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								{{--  <img src="{{asset('assets/images/!logged-user.jpg')}}" alt="Joseph Doe" class="img-circle" data-lock-picture="{{asset('assets/images/!logged-user.jpg')}}" />  --}}
							</figure>
							<div class="profile-info">
								{{--  <span class="name">John Doe Junior</span>
								<span class="role">administrator</span>  --}}
								@guest
                            		@if (Route::has('register'))
										<li class="nav-item">

										</li>
									@endif
								@else
									{{--  <li class="nav-item dropdown">
										<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>  --}}
											<span class="name">{{ Auth::user()->name }}</span>
										{{--  </a>  --}}

							</div>

							<i class="fa custom-caret"></i>
						</a>

						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="{{ route('logout') }}" onclick="event.preventDefault();
									document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{ __('Logout') }}</a>
								</li>

										{{--  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">  --}}
											{{--  <a class="dropdown-item" href="{{ route('logout') }}"
											onclick="event.preventDefault();
															document.getElementById('logout-form').submit();">
												{{ __('Logout') }}
											</a>  --}}

											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
										{{--  </div>  --}}

								@endguest
								{{--  <li>
									<a role="menuitem" tabindex="-1" href="pages-signin.html"><i class="fa fa-power-off"></i> Logout</a>
								</li>  --}}
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">

					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>

					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
								@canany('isMarketing|isAdmin')
									<li class="@yield('dashboard')">
										<a href="/dashboard">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
								@endcanany
								@cannot('isMarketing')
									<li class="@yield('master')">
										<a href="/master">
											<i class="fa fa-dropbox" aria-hidden="true"></i>
											<span>Master Barang</span>
										</a>
									</li>
								@endcannot
								@canany('isGudang|isAdmin')
                  					<li class="@yield('transaksi')">
										<a href="/transaksi">
											<i class="fa fa-bar-chart-o" aria-hidden="true"></i>
											<span>Transaksi</span>
										</a>
									</li>
								@endcanany
								@canany('isPengiriman|isAdmin')
                 					<li class="@yield('stock_keluar')">
										<a href="/stock-keluar">
											<i class="fa fa-truck" aria-hidden="true"></i>
											<span>Stock Keluar</span>
										</a>
									</li>
								@endcanany
								@can('isAdmin')
                  					<li class="@yield('lainnya')">
										<a href="/lainnya">
											<i class="fa fa-copy" aria-hidden="true"></i>
											<span>Lainnya</span>
										</a>
									</li>
									<li class="@yield('Tambah Pengguna')">
										<a href="/pengguna">
											<i class="fa fa-group" aria-hidden="true"></i>
											<span>Pengguna Sistem</span>
										</a>
									</li>
								@endcan
								</ul>
							</nav>

							<hr class="separator" />


						</div>

					</div>

				</aside>
				<!-- end: sidebar -->
        <!-- Section Main Content -->
        @yield('content')
        <!-- end main -->
			</div>

			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="#" class="mobile-close visible-xs">
							Collapse <i class="fa fa-chevron-right"></i>
						</a>

						<div class="sidebar-right-wrapper">

							<div class="sidebar-widget widget-calendar">
								<h6>Upcoming Tasks</h6>
								<div data-plugin-datepicker data-plugin-skin="dark" ></div>
							</div>



						</div>
					</div>
				</div>
			</aside>
		</section>

		<!-- Vendor -->
		<script src="{{asset('assets/vendor/jquery/jquery.js')}}"></script>
		<script src="{{asset('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
		<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.js')}}"></script>
		<script src="{{asset('assets/vendor/nanoscroller/nanoscroller.js')}}"></script>
		<script src="{{asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
		<script src="{{asset('assets/vendor/magnific-popup/magnific-popup.js')}}"></script>
		<script src="{{asset('assets/vendor/jquery-placeholder/jquery.placeholder.js')}}"></script>

		<!-- Specific Page Vendor -->
		<script src="{{asset('assets/vendor/select2/select2.js')}}"></script>
		<script src="{{asset('assets/vendor/jquery-datatables/media/js/jquery.dataTables.js')}}"></script>
		<script src="{{asset('assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js')}}"></script>
		<script src="{{asset('assets/vendor/jquery-datatables-bs3/assets/js/datatables.js')}}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{asset('assets/javascripts/theme.js')}}"></script>

		<!-- Theme Custom -->
		<script src="{{asset('assets/javascripts/theme.custom.js')}}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{asset('assets/javascripts/theme.init.js')}}"></script>


		<!-- Examples -->
		<script src="{{asset('assets/javascripts/tables/examples.datatables.default.js')}}"></script>
		<script src="{{asset('assets/javascripts/tables/examples.datatables.row.with.details.js')}}"></script>
		<script src="{{asset('assets/javascripts/tables/examples.datatables.tabletools.js')}}"></script>

		@yield('script_master')
		@yield('script_transaksi')
		@yield('script_stock_keluar')
		@yield('script_kategori')
		@yield('script_merk')
		@yield('script_vendor')
		@yield('script_outlet')
		@yield('script_stock_keluar')
		@yield('script_pengguna')

		<script>
	        $(function() {
	            $('#outletTable').DataTable({
	                scrollX : true,
	                scrollCollapse : true,
	                "autoWidth": false
	            });
	        });
		</script>

		<!-- <script>
			$(".snTransaksi").on("submit", function(){
				return confirm("Data transaksi berhasil disimpan. Tambah SN lagi?");
			});
		</script> -->

		<!-- <script>
	        $("#tambahStock").on("submit", function(){
	            return confirm("Data stock keluar berhasil disimpan. Tambah SN lagi?");
	        });
		</script> -->



	</body>
</html>
