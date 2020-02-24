@extends('_admin.partials.master')
@section('page_title', 'List all Products | Inner Beauty')
@section('page_heading', 'List all Products')

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
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Stock Qty</th>
                                    <th>Selling Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset($product->product_images()->first()->originalImagePath) }}" height="100px" width="100px">
                                        </td>
                                        <td> {{ $product->title }}</td>
                                        <td>
                                            {!! Str::limit($product->description, 40, ' ...') !!}
                                        </td>
                                        <td>
                                            {{ $product->stockQuantity }}

                                            @if($product->stockStatus == 'in_stock')
                                                <span class="badge badge-success">In Stock</span>
                                            @else
                                                <span class="badge badge-danger">Out of Stock</span>
                                            @endif
                                        </td>

                                        <!-- <td> ${{ $product->sellingPrice }} (<del> ${{ $product->regularPrice }} </del>)</td> -->
                                        <td> ${{ $product->sellingPrice }} </td>
                                        <td>

                                            <a href="{{ route('admin_product_edit', $product->unqId ) }}" class="btn btn-icon btn-info btn-sm">
                                                <i class="la la-eye"></i>
                                            </a>

                                            {!! Form::open(array(
                                                    'route' => array('admin_product_delete', $product->unqId),
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