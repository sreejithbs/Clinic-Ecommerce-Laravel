@extends('_clinic.partials.master')
@section('page_title', 'List all Sale Orders | Inner Beauty')
@section('page_heading', 'List all Sale Orders')

@section('content')

<section id="basic-form-layouts">
    <div class="row">
        <div class="col-md-3 ml-auto">
            <div class="float-md-right">
                <a href="{{ route('clinic_sales_create') }}" class="btn btn-info btn-sm">
                    <i class="la la-plus-square"></i> Add New Sale Order
                </a>
            </div>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content collpase show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dtTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Order ID</th>
                                    <th>Products</th>
                                    <th>Customer Type</th>
                                    <th>Total Price</th>
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
                                                    $title .= "<strong> & " . ($count-1) ." more products</strong>";
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