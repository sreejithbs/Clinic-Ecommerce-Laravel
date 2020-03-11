@extends('_admin.partials.master')
@section('page_title', 'Admin Dashboard | Inner Beauty')
@section('page_heading', 'Admin Dashboard')

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
								<i class="la la-institution info font-large-2 float-left"></i>
							</div>
							<div class="media-body text-right">
								<h3> {{ $clinics_count }}</h3>
								<span>Total Clinics</span>
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
								<i class="la la-users info font-large-2 float-left"></i>
							</div>
							<div class="media-body text-right">
								<h3>10</h3>
								<span>Total Online Users</span>
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


<!-- Column Chart -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Product Sales Chart</h4>
			</div>
			<div class="card-content collapse show">
				<div class="card-body">
					<canvas id="column-chart" height="400"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('page_scripts')
	<script src="{{ asset('modern_admin_assets/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>

	<script type="text/javascript">
		// Column Bar chart
		$(window).on("load", function(){

		    //Get the context of the Chart canvas element we want to select
		    var ctx = $("#column-chart");

		    // Chart Options
		    var chartOptions = {
		        // Elements options apply to all of the options unless overridden in a dataset
		        // In this case, we are setting the border of each bar to be 2px wide and green
		        elements: {
		            rectangle: {
		                borderWidth: 2,
		                borderColor: 'rgb(0, 255, 0)',
		                borderSkipped: 'bottom'
		            }
		        },
		        responsive: true,
		        maintainAspectRatio: false,
		        responsiveAnimationDuration:500,
		        legend: {
		            position: 'top',
		        },
		        scales: {
		            xAxes: [{
		                display: true,
		                gridLines: {
		                    color: "#f3f3f3",
		                    drawTicks: false,
		                },
		                scaleLabel: {
		                    display: true,
		                },
		                ticks: {
		                	padding: 10
		                }
		            }],
		            yAxes: [{
		                display: true,
		                gridLines: {
		                    color: "#f3f3f3",
		                    drawTicks: false,
		                },
		                scaleLabel: {
		                    display: true,
		                }
		            }]
		        },
		        title: {
		            display: true,
		            text: 'Online v/s Offline Clinic Sales Data'
		        }
		    };

		    // Chart Data
		    var chartData = {
		        labels: ["January", "February", "March", "April", "May", "June"],
		        datasets: [{
		            label: "Online Sales Volume",
		            data: [65, 59, 80, 81, 56, 22],
		            backgroundColor: "#28D094",
		            hoverBackgroundColor: "rgba(22,211,154,.9)",
		            borderColor: "transparent"
		        }, {
		            label: "Clinic Sales Volume",
		            data: [28, 48, 40, 19, 86, 98],
		            backgroundColor: "#F98E76",
		            hoverBackgroundColor: "rgba(249,142,118,.9)",
		            borderColor: "transparent"
		        }]
		    };

		    var config = {
		        type: 'bar',

		        // Chart Options
		        options : chartOptions,

		        data : chartData
		    };

		    // Create the chart
		    var lineChart = new Chart(ctx, config);
		});
	</script>
@endpush