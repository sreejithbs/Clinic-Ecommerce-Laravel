@extends('_admin.partials.master')
@section('page_title', 'Add New Inventory Transfer | Inner Beauty')
@section('page_heading', 'Add New Inventory Transfer for Product : ' . $product->title)

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
                        <form method="post" action="{{ route('admin_inventory_transfer_store', $product->unqId) }}" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="">
                        	{{ csrf_field() }}
                            <div class="form-body">
                                <h4 class="form-section">
                                	<i class="ft-rotate-cw"></i> Transfer Info
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="transfer_reference_num">Transfer Reference Number *</label>
                                    <div class="col-md-5">
                                        <input type="text" id="transfer_reference_num" class="form-control" value="transfer_{{ StringHelper::randString(8) }}" placeholder="Transfer Reference Number" name="transfer_reference_num" required data-parsley-required-message="Please enter Transfer Reference Number" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="transfer_order_number">Transfer Order Number</label>
                                    <div class="col-md-5">
                                        <input type="text" id="transfer_order_number" class="form-control" placeholder="Transfer Order Number" name="transfer_order_number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="clinic">Select Clinic *</label>
                                    <div class="col-md-5">
                                        <select id="clinic" class="form-control select2" name="clinic" required data-parsley-required-message="Please select a Clinic" data-parsley-errors-container="#clinic_errorDiv">
                                            <option value="">-- Select an option --</option>
                                            @foreach($clinics as $clinic)
                                                <option value="{{ $clinic->unqId }}">
                                                    {{ $clinic->clinic_profile->clinicName }} - {{ $clinic->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div id="clinic_errorDiv"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="quantity">Quantity *</label>
                                    <div class="col-md-5">
                                        <input type="number" class="form-control quantity" placeholder="Quantity" name="quantity" min="1" max="{{ $product->stockQuantity }}" required data-parsley-required-message="Please enter Quantity" data-prod_price="{{ $product->sellingPrice }}">
                                        <div class="help-block">
                                            <small> Available Stock Quantity : {{ $product->stockQuantity }}</small>
                                        </div>
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
                                        <div class="help-block">
                                            <small> Unit Price: ${{ $product->sellingPrice }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="transfer_date_time">Transfer Date & Time *</label>
                                    <div class="col-md-5">
                                        <input type="text" id="datetimepicker" class="form-control" placeholder="Transfer Date Time" name="transfer_date_time" required data-parsley-required-message="Please choose Transfer Date Time">
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="notes">Transfer Note</label>
                                    <div class="col-md-9">
                                        <textarea id="notes" rows="5" class="form-control" name="notes" placeholder="Transfer Note"></textarea>
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