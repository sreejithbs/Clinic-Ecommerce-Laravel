@extends('_admin.partials.master')
@section('page_title', 'List all Inventory Purchases | Inner Beauty')
@section('page_heading', 'List all Inventory Purchases')

@section('content')

<section id="basic-form-layouts">
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
                                    <th>Date</th>
                                    <th>Products</th>
                                    <th>Total Price</th>
                                    <th>Supplier Name</th>
                                    <th>Payment Mode</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventory_purchases as $inventory_purchase)
                                    <tr>
                                        <td> {{ $inventory_purchase->dateTime }} </td>
                                        <td>
                                            @php
                                                $count = $inventory_purchase->products()->count();
                                                $title = $inventory_purchase->products()->first()->title;
                                                if($count > 1){
                                                    $title .= "<strong> & " . ($count-1) ." more products</strong>";
                                                }
                                                echo $title;
                                            @endphp
                                        </td>
                                        <td> $ {{ $inventory_purchase->totalPrice }} </td>
                                        <td> {{ $inventory_purchase->supplier->name }} </td>
                                        <td> {{ ucfirst($inventory_purchase->paymentMode) }} </td>
                                        <td>
                                            <!-- <a href="" class="btn btn-icon btn-info btn-sm">
                                                <i class="la la-eye"></i>
                                            </a> -->
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