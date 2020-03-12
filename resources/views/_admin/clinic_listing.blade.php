@extends('_admin.partials.master')
@section('page_title', 'List all Clinics | Inner Beauty')
@section('page_heading', 'List all Clinics')

@section('page_styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/forms/toggle/bootstrap-switch.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/plugins/forms/switch.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/core/colors/palette-switch.min.css') }}">
@stop

@section('content')

<section id="basic-form-layouts">

	<div class="row">
		<div class="col-md-3 ml-auto">
			<div class="float-md-right">
				<a href="{{ route('admin_clinic_create') }}" class="btn btn-info btn-sm">
					<i class="la la-plus-square"></i> Add New Clinic
				</a>
			</div>
		</div>
	</div>
	<br/>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<!-- <div class="card-header"> -->
					<!-- <h4 class="card-title" id="bordered-layout-basic-form"></h4> -->
				<!-- </div> -->
				<div class="card-content collpase show">
					<div class="card-body card-dashboard">
						<table class="table table-striped table-bordered dtTable">
							<thead>
								<tr>
									<th>#</th>
									<!-- <th>Reference ID</th> -->
									<th>Name</th>
									<th>Address</th>
									<th>Email ID</th>
									<th>Account Status</th>
									<th>Toggle Account Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($clinics as $clinic)
									<tr>
										<td> {{ $loop->iteration }}</td>
										<!-- <td> {{ $clinic->clinic_profile->clinicReferenceId }}</td> -->
										<td> {{ $clinic->clinic_profile->clinicName }}</td>
										<td>
											{!! Str::limit($clinic->clinic_profile->clinicAddress, 40, ' ...') !!}
										</td>
										<td> {{ $clinic->email }} </td>
										<td>
											@if($clinic->status == 'active')
												<span class="badge badge-success"> Active </span>
											@else
												<span class="badge badge-danger"> Suspended </span>
											@endif
										</td>
										<td data-unq_id="{{ $clinic->unqId }}">
											**** Small Switch **** (class: toggleStatus)
										</td>
										<td>
											<a href="{{ route('admin_clinic_edit', $clinic->unqId ) }}" class="btn btn-icon btn-info btn-sm">
												<i class="la la-eye"></i>
											</a>

											{!! Form::open(array(
													'route' => array('admin_clinic_delete', $clinic->unqId),
													'method' => 'delete',
													'class'=>'delSwalForm',
													'style'=>'display:inline'
											)) !!}

											<button type="submit" class="btn btn-icon btn-danger btn-sm delSwal">
												<i class="la la-trash"></i>
											</button>

											{!! Form::close() !!}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@push('page_scripts')
	<script src="{{ asset('modern_admin_assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('modern_admin_assets/js/scripts/forms/switch.min.js') }}" type="text/javascript"></script>

	<script type="text/javascript">
		$(function(){

			$('body').on('change', '.toggleStatus', function(){

				var $elm = $(this);
				$.ajax({
					url: "{{ URL::route('admin_clinic_toggle_status') }}",
					dataType: 'json',
					type: 'POST',
					data: {
						'status' : $elm.val(),
						'clinic_unqid' : $elm.parent('td').attr('data-unq_id')
					},
					success:function(response){
						if(response.status){
							swal({
							    type: 'success',
							    title: response.message,
							    showConfirmButton: true,
							    timer: 1500
							});

						    setTimeout(function(){
						        window.location.reload();
						    }, 2000);

						} else{
							swal.close();
							toastr.error(response.message, 'Error !', {timeOut: 2000});
						}
					},
					error:function(response) {
						console.log('inisde ajax error handler');
					}
				});
			});

		});
	</script>
@endpush