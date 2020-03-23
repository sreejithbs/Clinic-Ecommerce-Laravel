@extends('_admin.partials.master')
@section('page_title', 'View Clinic Order Details | Inner Beauty')
@section('page_heading', 'View Clinic Order Details')

@section('page_styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/pages/ecommerce-cart.min.css') }}">
@stop

@section('content')

<div class="shopping-cart">
	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-content">
			        <div class="card-body">
			            <div class="d-flex justify-content-around lh-condensed">
			                <div class="order-details text-center">
			                    <div class="order-title"><strong>Order ID</strong></div>
			                    <div class="order-info"> {{ $user_order->orderRefNum }} </div>
			                </div>
			                <div class="order-details text-center">
			                    <div class="order-title"><strong>Order Date</strong></div>
			                    <div class="order-info"> {{ $user_order->dateTime }} </div>
			                </div>
			                <div class="order-details text-center">
			                    <div class="order-title"><strong>Total Amount</strong></div>
			                    <div class="order-info"> ${{ $user_order->netTotal }} </div>
			                </div>
			                <div class="order-details text-center">
			                    <div class="order-title"><strong>Customer Type</strong></div>
			                    <div class="order-info">
			                    	@if( $user_order->isWalkinCustomer == 0 )
			                    		Registered Customer
			                    	@else
			                    		Walk-in Customer
			                    	@endif
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>

			<div class="card">
			    <div class="card-header">
			        <h4 class="card-title">Products Details</h4>
			    </div>
			    <div class="card-content">
			        <div class="card-body">
			            <div class="table-responsive">
			                <table class="table table-bordered table-striped mb-0">
			                    <thead>
			                        <tr>
			                            <th>#</th>
			                            <th>Product Image</th>
			                            <th>Product Name</th>
			                            <th>Quantity</th>
			                            <th>Sub-Total</th>
			                            <!-- <th>Order Notes</th> -->
			                        </tr>
			                    </thead>
			                    <tbody>
			                    	@foreach($user_order->products()->get() as $product)
				                        <tr>
				                        	<td> {{ $loop->iteration }} </td>
				                            <td>
				                                <div class="product-img d-flex align-items-center">
				                                    <img class="img-fluid" src="{{ asset($product->product_images()->first()->originalImagePath) }}" alt="Image">
				                                </div>
				                            </td>
				                            <td> {{ $product->title }} </td>
				                            <td> {{ $product->pivot->quantity }} </td>
				                            <td>
				                                <div> ${{ $product->pivot->subTotal }} </div>
				                            </td>
				                            <!-- <td> {{ $user_order->notes }} </td> -->
				                        </tr>
				                    @endforeach
			                    </tbody>
			                </table>
			            </div>
			        </div>
			    </div>
			</div>

			@if( $user_order->isWalkinCustomer == 0 )
				<div class="card">
				    <div class="card-header">
				        <h4 class="card-title">Customer Details</h4>
				    </div>
				    <div class="card-content">
				        <div class="card-body">
				            <div class="table-responsive">
	                        	<table class="table table-bordered table-striped mb-0 txt-left">
				                    <thead>
				                        <tr>
				                            <th>Customer Name</th>
				                            <th>Email</th>
				                            <th>Customer Since</th>
				                        </tr>
				                    </thead>
				                    <tbody>
				                        <tr>
				                        	<td> {{ $user_order->customer->name }} </td>
				                        	<td> {{ $user_order->customer->email }} </td>
				                        	<td> {{ $user_order->customer->created_at->format('d/m/Y g:i A') }} </td>
				                        </tr>
				                    </tbody>
				                </table>
				            </div>
				        </div>
				    </div>
				</div>
			@endif

			<div class="card">
			    <div class="card-header">
			        <h4 class="card-title">Source Clinic Details</h4>
			    </div>
			    <div class="card-content">
			        <div class="card-body">
			            <div class="table-responsive">
                        	<table class="table table-bordered table-striped mb-0 txt-left">
			                    <thead>
			                        <tr>
			                            <th>Clinic Name</th>
			                            <th>Clinic Address</th>
			                            <th>Email</th>
			                            <th>Commission</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                        <tr>
			                        	<td> {{ $user_order->created_clinic->clinic_profile->clinicName }} </td>
			                        	<td> {{ $user_order->created_clinic->clinic_profile->clinicAddress }} </td>
			                        	<td> {{ $user_order->created_clinic->email }} </td>
			                        	<td> {{ $user_order->created_clinic->clinic_profile->commissionPercentage }} %</td>
			                        </tr>
			                    </tbody>
			                </table>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>

@endsection