@extends('_admin.partials.master')
@section('page_title', 'List all Clinic Orders | Inner Beauty')
@section('page_heading', 'List all Clinic Orders')

@section('content')

<section id="basic-form-layouts">
	<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered table-responsive dtTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Order ID</th>
                                    <th>Products</th>
                                    <th>Customer Type</th>
                                    <th>Total Amount</th>
                                    <th>Source Clinic</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user_orders as $user_order)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $user_order->dateTime }} </td>
                                        <td> {{ $user_order->orderRefNum }} </td>
                                        <td>
                                            @php
                                                $count = $user_order->products()->count();
                                                $title = $user_order->products()->first()->title;
                                                if($count > 1){
                                                    $title .= "<br/><strong> & " . ($count-1) ." more </strong>";
                                                }
                                                echo $title;
                                            @endphp
                                        </td>
                                        <td>
                                            @if( $user_order->isWalkinCustomer == 1 )
                                                <span class="badge badge-warning"> walk-in </span>
                                            @else
                                                <span class="badge badge-success"> registered </span>
                                            @endif
                                        </td>
                                        <td> ${{ $user_order->netTotal }} </td>
                                        <td> {{ $user_order->created_clinic->clinic_profile->clinicName }} </td>
                                        <td>
                                            <a href="{{ route('admin_order_clinic_view', $user_order->unqId ) }}" class="btn btn-icon btn-info btn-sm">
                                                <i class="la la-eye"></i>
                                            </a>
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