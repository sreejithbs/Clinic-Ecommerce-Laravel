@extends('_admin.partials.master')
@section('page_title', 'Add new Inventory Purchase | Inner Beauty')
@section('page_heading', 'Add new Inventory Purchase')

@section('content')

<section id="basic-form-layouts">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header">
                    <h4 class="card-title" id="bordered-layout-basic-form">Info</h4>
                </div> -->
                <div class="card-content collpase show">
                    <div class="card-body">
                        <!-- <div class="card-text">
                            <p>Info</p>
                        </div> -->
                        <form method="post" action="{{ route('admin_inventory_purchase_store') }}" enctype="multipart/form-data" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="">
                        	{{ csrf_field() }}
                            <div class="form-body">
                                <h4 class="form-section">
                                	<i class="ft-clipboard"></i> Purchase Product Info
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="product">Select Product *</label>
                                    <div class="col-md-9">
                                        <select id="product" class="form-control select2" name="product" required data-parsley-required-message="Please select a Product" data-parsley-errors-container="#prod_errorDiv">
                                            <option value="">-- Select an option --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->unqId }}"> {{ $product->title }} </option>
                                            @endforeach
                                        </select>
                                        <div id="prod_errorDiv"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="quantity">Quantity *</label>
                                    <div class="col-md-9">
                                        <input type="number" id="quantity" class="form-control" placeholder="Quantity" name="quantity" min="1" required data-parsley-required-message="Please enter Quantity">
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="total_price">Total Price *</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" id="total_price" class="form-control" placeholder="Total Price" name="total_price" min="0" step="0.1" required data-parsley-required-message="Please enter Total Price" data-parsley-errors-container="#total_errorDiv">
                                        </div>
                                        <div id="total_errorDiv"></div>
                                    </div>
                                </div>

                                <h4 class="form-section">
                                    <i class="ft-clipboard"></i> Purchase Billing Info
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="supplier">Select Supplier *</label>
                                    <div class="col-md-9">
                                        <select id="supplier" class="form-control select2" name="supplier" required data-parsley-required-message="Please select a Supplier" data-parsley-errors-container="#supplier_errorDiv">
                                            <option value="">-- Select an option --</option>
                                            <option value="1">Lalaine</option>
                                        </select>
                                        <div id="supplier_errorDiv"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                	<label class="col-md-3 label-control" for="purchase_date_time">Purchase Date & Time *</label>
                                	<div class="col-md-9">
                                        <input type="text" id="datetimepicker" class="form-control" placeholder="Purchase Date Time" name="purchase_date_time" required data-parsley-required-message="Please choose Purchase Date Time">
                                	</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="notes">Purchase Note *</label>
                                    <div class="col-md-9">
                                        <textarea id="notes" rows="5" class="form-control" name="notes" placeholder="Purchase Note" required data-parsley-required-message="Please enter Purchase Note"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">Purchase Attachment </label>
                                    <div class="col-md-9">
                                        <div class="controls">
                                            <input type="file" name="attachment" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">Choose Purchase Status *</label>
                                    <div class="col-md-9">
                                        <div class="input-group skin skin-square">
                                            <div class="d-inline-block custom-control custom-radio" style="padding-left: 0px;">
                                                <input type="radio" name="payment_status" class="custom-control-input" id="ordered" required data-parsley-required-message="Please choose Purchase Status" data-parsley-errors-container="#status_errorDiv">
                                                <label for="ordered">Ordered</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="payment_status" class="custom-control-input" id="pending">
                                                <label for="pending">Pending</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="payment_status" class="custom-control-input" id="received">
                                                <label for="received">Received</label>
                                            </div>
                                        </div>
                                        <div id="status_errorDiv"></div>
                                        <div class="help-block">
                                            <small>N.B: Only stocks with Purchase status as <strong>received</strong> will be added to available stocks.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control">Choose Payment Mode *</label>
                                    <div class="col-md-9">
                                        <div class="input-group skin skin-square">
                                            <div class="d-inline-block custom-control custom-radio" style="padding-left: 0px;">
                                                <input type="radio" name="payment_mode" class="custom-control-input" id="cash" required data-parsley-required-message="Please choose Payment Mode" data-parsley-errors-container="#mode_errorDiv">
                                                <label for="cash">Cash</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="payment_mode" class="custom-control-input" id="credit">
                                                <label for="credit">Credit</label>
                                            </div>
                                        </div>
                                        <div id="mode_errorDiv"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                {{-- <a href="{{ route('admin_product_list' ) }}" class="btn btn-warning mr-1">
                                    <i class="ft-x"></i> Cancel
                                </a> --}}
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection