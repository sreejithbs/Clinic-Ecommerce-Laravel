<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<!-- <meta name="description" content=""> -->
	<!-- <meta name="keywords" content=""> -->
	<!-- <meta name="author" content=""> -->
	
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('page_title')</title>

	@include('_admin.partials.styles')

	@yield('page_styles')

</head>

<body class="vertical-layout vertical-content-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">

	<!-- NAVBAR -->
	@include('_admin.partials.navbar')

	<div class="app-content content">
		<div class="content-wrapper">
			<div class="content-header row">
				<div class="content-header-left col-md-6 col-12 mb-2">
					<h3 class="content-header-title">
						<strong> @yield('page_heading') </strong>
					</h3>
				</div>
				<div class="content-header-right col-md-6 col-12">
					<div class="float-md-right">
						<a href="{{ route('admin_dashboard') }}" class="btn btn-info round btn-glow px-2">
						    <i class="la la-home"></i> Home
						</a>
					</div>
				</div>
			</div>

			<!-- Sidebar-->
			@include('_admin.partials.sidebar')

			<div class="content-body">

				<!-- Passing BASE URL to AJAX -->
				<input id="base_url" type="hidden" value="{{ URL::to('/') }}">

				@yield('content')

			</div>
		</div>
	</div>

	<!-- FOOTER -->
	@include('_admin.partials.footer')

	<!-- Scripts -->
	@include('_admin.partials.scripts')
	@stack('page_scripts')
	<!-- @yield('page_scripts') -->

	@include('flash_msgs')

</body>
</html>