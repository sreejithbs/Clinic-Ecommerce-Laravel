@extends('_shop.partials.master')
@section('page_title', 'Cart | Inner Beauty')

@section('content')

<div class="clearfix">
    <h2 class="page-title">Your Shopping Cart</h2>
    <a href="{{ route('home') }}" class="btn btn-info btn-sm"> Continue Shopping </a>
</div><br/>
<div class="row">
    <main class="col-sm-9">
        @if (Cart::isEmpty())
            <p class="alert alert-warning">Your shopping cart is empty.</p>
        @else
            <div class="card">
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sub-Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Cart::getContent() as $product)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td>
                                    <img src="{{ asset($product->model->product_images()->first()->originalImagePath) }}" height="80px" width="80px">
                                </td>
                                <td> {{ $product->name }} </td>
                                <td> ${{ $product->model->sellingPrice }} </td>
                                <td> {{ $product->quantity }} </td>
                                <td> ${{ $product->getPriceSum() }} </td>
                                <td>
                                    <a href="{{ route('remove_from_cart', $product->id) }}" class="btn btn-outline-danger">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>

    <aside class="col-sm-3">
        <a href="{{ route('clear_cart') }}" class="btn btn-danger btn-block mb-4"> Clear Cart </a>
        <hr>
        <div class="row">
            <div class="col-md-6"> <h4><strong> Cart Total: </strong></h4></div>
            <div class="col-md-6 text-right"> <h4><strong> $ {{ Cart::getTotal() }} </strong></h4></div>
        </div>
        @if(! Cart::isEmpty())
            <hr>
            <a href="{{ route('checkout_create') }}" class="btn btn-success btn-lg btn-block"> Proceed To Checkout </a>
        @endif
    </aside>
</div>

@endsection