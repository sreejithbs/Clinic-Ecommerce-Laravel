@extends('_admin.partials.master')
@section('page_title', 'View Inventory Log | Inner Beauty')
@section('page_heading', 'View Inventory Log')

@section('content')

@if($statusCode == 0)
    @include('_admin.components.inventory_create_partial', ['inventory_log' => $inventory_log, 'product' => $product ])
@elseif($statusCode == 1)
    @include('_admin.components.inventory_purchase_partial', ['inventory_log' => $inventory_log, 'inventory_purchase' => $inventory_purchase ])
@elseif($statusCode == 2)
    @include('_admin.components.inventory_transfer_partial', ['inventory_log' => $inventory_log, 'inventory_transfer' => $inventory_transfer ])
@elseif($statusCode == 4)
    @include('_admin.components.clinic_sale_partial', ['inventory_log' => $inventory_log, 'product' => $product, 'user_order' => $user_order ])
@endif

@endsection