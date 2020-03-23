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

	@include('_shop.partials.styles')

	@yield('page_styles')

</head>

<body>

	<!-- NAVBAR -->
	@include('_shop.partials.navbar')

	@include('_shop.partials.sidebar')

	<div class="container">
		@yield('content')
	</div>

	<!-- FOOTER -->
	@include('_shop.partials.footer')

	<!-- Scripts -->
	@include('_shop.partials.scripts')
	@stack('page_scripts')

	@include('flash_msgs')

</body>
</html>