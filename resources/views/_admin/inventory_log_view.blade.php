@extends('_admin.partials.master')
@section('page_title', 'View Inventory Log | Inner Beauty')
@section('page_heading', 'View Inventory Log')

@section('content')

@if($statusCode == 1)
    @include('_admin.components.inventory_purchase_partial', ['inventory_log' => $inventory_log, 'inventory_purchase' => $inventory_purchase ])
@elseif($statusCode == 2)
    @include('_admin.components.inventory_transfer_partial', ['inventory_log' => $inventory_log, 'inventory_transfer' => $inventory_transfer ])
@endif

@endsection