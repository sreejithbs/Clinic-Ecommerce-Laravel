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
                <a href="{{ route('admin_inventory_transfer_create', $product->unqId) }}" class="btn btn-warning btn-sm">
                    <i class="la la-minus-square"></i> Transfer Inventory
                </a>
            </div>
        </div>
    </div>
    <br/>

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
                                    <th>Particulars</th>
                                    <th>Order ID</th>
                                    <th>Opening Inventory</th>
                                    <th>Quantity</th>
                                    <th>Closing Inventory</th>
                                    <th>Actions</th>
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
                                                <span class="badge badge-success">
                                            @else
                                                <span class="badge badge-danger">
                                            @endif

                                            {{ $inventory_log->quantity }} </span>
                                        </td>
                                        <td> {{ $inventory_log->closingQty }} </td>
                                        <td>
                                            <a href="{{ route('admin_inventory_log_view', $inventory_log->unqId ) }}" class="btn btn-icon btn-info btn-sm">
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