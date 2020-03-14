@extends('_admin.partials.master')
@section('page_title', 'Add New Inventory Purchase | Inner Beauty')
@section('page_heading', 'Add New Inventory Purchase for Product : ' . $product->title)

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
                        <form method="post" action="{{ route('admin_inventory_purchase_store', $product->unqId) }}" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="">
                        	{{ csrf_field() }}
                            <div class="form-body">
                                <h4 class="form-section">
                                	<i class="ft-clipboard"></i> Purchase Info
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="purchase_reference_num">Purchase Reference Number *</label>
                                    <div class="col-md-5">
                                        <input type="text" id="purchase_reference_num" class="form-control" value="purchase_{{ StringHelper::randString(8) }}" placeholder="Purchase Reference Number" name="purchase_reference_num" required data-parsley-required-message="Please enter Purchase Reference Number" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="purchase_order_number">Purchase Order Number</label>
                                    <div class="col-md-5">
                                        <input type="text" id="purchase_order_number" class="form-control" placeholder="Purchase Order Number" name="purchase_order_number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="quantity">Quantity *</label>
                                    <div class="col-md-5">
                                        <input type="number" class="form-control quantity" placeholder="Quantity" name="quantity" min="1" required data-parsley-required-message="Please enter Quantity" data-prod_price="{{ $product->sellingPrice }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="total_price">Total Price</label>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" id="total_price" class="form-control" value="0" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="purchase_date_time">Purchase Date & Time *</label>
                                    <div class="col-md-5">
                                        <input type="text" id="datetimepicker" class="form-control" placeholder="Purchase Date Time" name="purchase_date_time" required data-parsley-required-message="Please choose Purchase Date Time">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="supplier">Supplier</label>
                                    <div class="col-md-9">
                                        <input type="text" id="supplier" class="form-control" placeholder="Supplier" name="supplier">
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="notes">Purchase Note</label>
                                    <div class="col-md-9">
                                        <textarea id="notes" rows="5" class="form-control" name="notes" placeholder="Purchase Note"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <a href="{{ route('admin_inventory_logs_list', $product->unqId ) }}" class="btn btn-warning mr-1">
                                    <i class="la la-close"></i> Cancel
                                </a>
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

@push('page_scripts')
    <script type="text/javascript">

        $(function(){

            // Product Quantity Change
            $('body').on('change', '.quantity', function(){

                var total = 0;
                if($(this).val() == '' || isNaN( $(this).val() )){
                    toastr.error('Please enter a valid quantity', 'Error !', {timeOut: 2000});
                } else{
                    var unit_qty = parseInt( $(this).val() );
                    var unit_price = parseFloat( $(this).attr('data-prod_price') );
                    total = unit_price * unit_qty;
                }
                $("#total_price").val(total);
            });
        });

    </script>
@endpush