@extends('_shop.partials.master')
@section('page_title', 'HomePage | Inner Beauty')

@section('content')

<h3 class="text-center">All Products</h3>

<div class="row">
    @foreach($products as $product)
        <div class="col-md-4">
            <div class="thumbnail">
                <img src="{{ asset($product->product_images()->first()->originalImagePath) }}" alt="Image" class="img-responsive">
                <div class="caption">
                    <h3>{{ $product->title }}</h3>
                    <p class="description">
                        {!! Str::limit($product->description, 40, ' ...') !!}
                    </p>
                    <div class="clearfix">
                        <div class="pull-left price"> ${{ $product->sellingPrice }}</div>
                        <a href="{{ route('add_to_cart', $product->unqId) }}" class="btn btn-success pull-right">
                            Add to Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection