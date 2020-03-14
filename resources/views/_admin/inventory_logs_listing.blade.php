@extends('_admin.partials.master')
@section('page_title', 'List all Inventory Logs | Inner Beauty')
@section('page_heading', 'List all Inventory Logs for Product : ' . $product->title)

@section('content')

<section id="basic-form-layouts">

    <div class="row">
        <div class="col-md-6 ml-auto">
            <div class="float-md-right">
                <a href="{{ route('admin_inventory_purchase_create', $product->unqId) }}" class="btn btn-info btn-sm">
                    <i class="la la-plus-square"></i> Add Inventory
                </a>
                <a href="" class="btn btn-warning btn-sm">
                    <i class="la la-minus-square"></i> Deduct Inventory
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
                                    <th>Date</th>
                                    <th>Particulars</th>
                                    <th>Order ID</th>
                                    <th>Opening Inventory</th>
                                    <th>Quantity</th>
                                    <th>Closing Inventory</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventory_logs as $inventory_log)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $inventory_log->dateTime }} </td>
                                        <td> {{ $inventory_log->logEvent }} </td>
                                        <td> {{ $inventory_log->refNum }} </td>
                                        <td> {{ $inventory_log->openingQty }} </td>
                                        <td>
                                            @if( in_array($inventory_log->eventCode, [0, 1]) )
                                                <span class="badge badge-pill badge-success">
                                            @else
                                                <span class="badge badge-pill badge-danger">
                                            @endif

                                            {{ $inventory_log->quantity }} </span>
                                        </td>
                                        <td> {{ $inventory_log->closingQty }} </td>
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