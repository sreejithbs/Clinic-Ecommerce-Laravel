@extends('_clinic.partials.master')
@section('page_title', 'Clinic-Admin Dashboard | Inner Beauty')
@section('page_heading', 'Clinic-Admin Dashboard')

@section('content')

<!-- <div class="alert bg-success alert-icon-left mb-2" role="alert">
    <span class="alert-icon"><i class="la la-info"></i></span>
    <strong>Welcome</strong>
    <p>You have successfully logged in!</p>
</div> -->

<section id="minimal-statistics">
	<div class="row">
		<div class="col-xl-4 col-lg-6 col-12">
			<div class="card">
				<div class="card-content">
					<div class="card-body">
						<div class="media d-flex">
							<div class="align-self-center">
								<i class="la la-tasks info font-large-2 float-left"></i>
							</div>
							<div class="media-body text-right">
								<h3>10</h3>
								<span>Total Orders</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-4 col-lg-6 col-12">
			<div class="card">
				<div class="card-content">
					<div class="card-body">
						<div class="media d-flex">
							<div class="align-self-center">
								<i class="la la-money info font-large-2 float-left"></i>
							</div>
							<div class="media-body text-right">
								<h3>0</h3>
								<span>Total Sales</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-4 col-lg-6 col-12">
			<div class="card">
				<div class="card-content">
					<div class="card-body">
						<div class="media d-flex">
							<div class="align-self-center">
								<i class="la la-pencil-square info font-large-2 float-left"></i>
							</div>
							<div class="media-body text-right">
								<h3>0</h3>
								<span>Total Active Subscriptions</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection