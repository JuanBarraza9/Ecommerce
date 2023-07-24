<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('adminbackend/assets/images/favicon-32x32.png')}}" type="image/png" />
	<!--plugins-->
	<link href="{{asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
	<link href="{{asset('adminbackend/assets/plugins/input-tags/css/tagsinput.css')}}" rel="stylesheet" />
	<link href="{{asset('adminbackend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('adminbackend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('adminbackend/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- data table-->
	<script src="{{asset('adminbackend/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<link href="{{asset('adminbackend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	
	<!-- loader-->
	<link href="{{asset('adminbackend/assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{asset('adminbackend/assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('adminbackend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('adminbackend/assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('adminbackend/assets/css/icons.css')}}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{asset('adminbackend/assets/css/dark-theme.css')}}" />
	<link rel="stylesheet" href="{{asset('adminbackend/assets/css/semi-dark.css')}}" />
	<link rel="stylesheet" href="{{asset('adminbackend/assets/css/header-colors.css')}}" />
	<title>Dashboard - @yield('subtitle')</title>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
        @include('admin.body.sidebar')
		<!--start header -->
        @include('admin.body.header')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content"> 
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3 mx-2 d-flex align-items-center">@yield('title')</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
								<li class="breadcrumb-item active align-middle" aria-current="page">@yield('subtitle')</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						@yield('aditional')
					</div>
				</div>
				@yield('content')
			</div><!--page-content-->
		</div>
		
                
@include('admin.body.footer')