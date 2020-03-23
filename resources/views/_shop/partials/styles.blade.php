<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/extensions/toastr.css') }}">

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
		margin: 6px 0 3px;
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

	.thumbnail {
	    padding:20px;
	}
	.thumbnail img {
	    max-height: 150px;
	}
	.thumbnail .description {
	    color: #7f7f7f;
	}
	.price {
	    font-weight:bold;
	    font-size: 16px;
	}
	table th, tr{
		text-align: center !important;
	}
	.no-border td{
	    vertical-align: middle !important;
	    border-top: none !important;
	}
</style>