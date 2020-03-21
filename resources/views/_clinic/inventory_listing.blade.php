@extends('_clinic.partials.master')
@section('page_title', 'List all Inventory | Inner Beauty')
@section('page_heading', 'List all Inventory')

@section('content')

<section id="basic-form-layouts">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dtTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Clinic Inventory Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clinic_inventories as $clinic_inventory)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $clinic_inventory->product->title }} </td>
                                        <td>
                                            <img src="{{ asset($clinic_inventory->product->product_images()->first()->originalImagePath) }}" height="100px" width="100px">
                                        </td>
                                        <td> {!! Str::limit($clinic_inventory->product->description, 40, ' ...') !!} </td>
                                        <td>
                                            <span class="badge badge-success">
                                                {{ $clinic_inventory->stockQuantity }}
                                            </span>
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