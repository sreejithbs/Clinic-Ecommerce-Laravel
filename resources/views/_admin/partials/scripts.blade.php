 jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
<script src="{{ asset('modern_admin_assets/js/core/libraries/jquery.min.js') }}" type="text/javascript"></script>

<!-- Bootstrap -->
<!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="{{ asset('modern_admin_assets/js/core/libraries/bootstrap.min.js') }}" type="text/javascript"></script>

<!-- BEGIN VENDOR JS-->
<!-- <script src="{{ asset('modern_admin_assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script> -->
<!-- BEGIN VENDOR JS-->

<script src="{{ asset('modern_admin_assets/vendors/js/ui/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('modern_admin_assets/vendors/js/ui/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('modern_admin_assets/vendors/js/ui/unison.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('modern_admin_assets/vendors/js/ui/blockUI.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('modern_admin_assets/vendors/js/ui/jquery-sliding-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('modern_admin_assets/js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('modern_admin_assets/js/core/app.js') }}" type="text/javascript"></script>

<!-- TOASTR -->
<script src="{{ asset('modern_admin_assets/vendors/js/extensions/toastr.min.js') }}" type="text/javascript"></script>

<!-- Datatable -->
<script src="{{ asset('modern_admin_assets/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>

<!-- Jquery UI -->
<script src="{{ asset('modern_admin_assets/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>

<!-- Parsley -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js" type="text/javascript"></script>

<!-- SweetAlert -->
<script src="{{ asset('js/sweetalert2.all.min.js') }}" type="text/javascript"></script>
<!-- <script src="{{ asset('modern_admin_assets/vendors/js/extensions/sweetalert.min.js') }}" type="text/javascript"></script> -->

<script type="text/javascript">
	
	// Basic Datatable Initialization
	$(document).ready(function() {
		$('.dtTable').DataTable();
	});

	// SweetAlert in all DELETE BUTTONS
	$('.delSwal').on('click',function(event){
		event.preventDefault();
		swal({
			title: 'Are you sure?',
			text: "You won't be able to revert this operation.",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3c9fce',
			cancelButtonColor: '#e86256',
			confirmButtonText: 'Yes, delete it',
			cancelButtonText: 'No, cancel'
		}).then((result) => {
			if (result.value) {
				$(this).closest("form.delSwalForm").submit();
			}
		})
	});
</script>