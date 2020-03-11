
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
<link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">

<!-- BEGIN VENDOR CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/vendors.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/ui/prism.min.css')}}">
<!-- END VENDOR CSS-->

<!-- BEGIN MODERN CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/app.css')}}">
<!-- END MODERN CSS-->

<!-- BEGIN Page Level CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/core/menu/menu-types/vertical-content-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/core/colors/palette-gradient.css')}}">
<!-- END Page Level CSS-->

<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/extensions/toastr.css') }}">

<!-- Datatable -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/tables/datatable/datatables.min.css') }}">

<!-- LOADERS -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/plugins/loaders/loaders.min.css') }}">

<!-- SELECT2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/forms/selects/select2.min.css') }}">

<!-- iCheck -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/forms/icheck/icheck.css') }}">

<!-- jQuery DateTimePicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />

<!-- Jquery UI -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/ui/jquery-ui.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/plugins/ui/jqueryui.css') }}">

<!-- Sweet Alert -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/extensions/sweetalert.css') }}">

<style type="text/css">
	/* Parsley CSS */
	input:not([type=radio]).parsley-success,
	textarea.parsley-success,
	select.parsley-success {
		color: #468847;
		background-color: #DFF0D8;
		border: 1px solid #D6E9C6;
	}
	input:not([type=radio]).parsley-error,
	textarea.parsley-error,
	select.parsley-error {
		color: #B94A48;
		background-color: #F2DEDE;
		border: 1px solid #EED3D7;
	}
	.parsley-errors-list {
		color: red;
		margin: 2px 0 3px;
		padding: 0;
		list-style-type: none;
		font-size: 0.9em;
		line-height: 0.9em;
		opacity: 0;

		transition: all .3s ease-in;
		-o-transition: all .3s ease-in;
		-moz-transition: all .3s ease-in;
		-webkit-transition: all .3s ease-in;
	}
	.parsley-errors-list.filled {
		opacity: 1;
	}

	.appendDiv tr:not(.no-data){
		background-color: #d7e7ff;
	}

	.no-data{
		background-color: #ffb1b19e;
	}

	table tr, td{
		text-align: center !important;
	}
</style>