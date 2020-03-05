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
                                        <div class="row">
                                            <div class="col-md-8">
                                                <select id="product" class="form-control select2" name="product" required data-parsley-required-message="Please select a Product" data-parsley-errors-container="#prod_errorDiv">
                                                    <option value="">-- Select an option --</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->unqId }}"> {{ $product->title }} </option>
                                                    @endforeach
                                                </select>
                                                <div id="prod_errorDiv"></div>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="{{ route('admin_product_create') }}" class="btn btn-info btn-sm round">
                                                    <i class="la la-plus-square font-medium-2"></i> Add New Product
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="quantity">Quantity *</label>
                                    <div class="col-md-9">
                                        <div class="input-group mt-0">
                                            <!-- <div class="input-group-prepend">
                                                <span class="input-group-text">Current Stock : 0</span>
                                                <span class="input-group-text">+</span>
                                            </div> -->
                                            <input type="number" id="quantity" class="form-control" placeholder="Quantity" name="quantity" min="1" required data-parsley-required-message="Please enter Quantity">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="total_price">Total Price *</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" id="total_price" class="form-control" placeholder="Total Price" name="total_price" min="0" step="0.01" required data-parsley-required-message="Please enter Total Price" data-parsley-errors-container="#total_errorDiv">
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
                                        <div class="row">
                                            <div class="col-md-8">
                                                <select id="supplier" class="form-control select2" name="supplier" required data-parsley-required-message="Please select a Supplier" data-parsley-errors-container="#supplier_errorDiv">
                                                    <option value="">-- Select an option --</option>
                                                    @foreach($suppliers as $supplier)
                                                        <option value="{{ $supplier->unqId }}">
                                                            {{ $supplier->name }} - {{ $supplier->companyName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div id="supplier_errorDiv"></div>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-info btn-sm round" data-toggle="modal" data-target="#addSupplierModal">
                                                    <i class="la la-plus-square font-medium-2"></i> Add New Supplier
                                                </button>
                                            </div>
                                        </div>
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
                                <!-- <div class="form-group row">
                                    <label class="col-md-3 label-control">Choose Purchase Status *</label>
                                    <div class="col-md-9">
                                        <div class="input-group skin skin-square">
                                            <div class="d-inline-block custom-control custom-radio" style="padding-left: 0px;">
                                                <input type="radio" name="purchase_status" class="custom-control-input" id="ordered" value="ordered" required data-parsley-required-message="Please choose Purchase Status" data-parsley-errors-container="#status_errorDiv">
                                                <label for="ordered">Ordered</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="purchase_status" class="custom-control-input" id="pending" value="pending">
                                                <label for="pending">Pending</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="purchase_status" class="custom-control-input" id="received" value="received">
                                                <label for="received">Received</label>
                                            </div>
                                        </div>
                                        <div id="status_errorDiv"></div>
                                        <div class="help-block">
                                            <small>N.B: Only stocks with Purchase status as <strong>received</strong> will be added to available stocks.</small>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control">Choose Payment Mode *</label>
                                    <div class="col-md-9">
                                        <div class="input-group skin skin-square">
                                            <div class="d-inline-block custom-control custom-radio" style="padding-left: 0px;">
                                                <input type="radio" name="payment_mode" class="custom-control-input" id="cash"  value="cash" required data-parsley-required-message="Please choose Payment Mode" data-parsley-errors-container="#mode_errorDiv">
                                                <label for="cash">Cash</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="payment_mode" class="custom-control-input" id="credit" value="credit">
                                                <label for="credit">Credit</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="payment_mode" class="custom-control-input" id="others" value="others">
                                                <label for="others">Others</label>
                                            </div>
                                        </div>
                                        <div id="mode_errorDiv"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <a href="{{ route('admin_inventory_purchase_list' ) }}" class="btn btn-warning mr-1">
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

<!-- Modal -->
<div class="modal fade text-left" id="addSupplierModal" tabindex="-1" role="dialog" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addSupplierModalLabel">
                    <i class="la la-road2"></i> Add New Supplier
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" method="POST" id="supplierForm" novalidate="" data-parsley-validate="">
                {{ csrf_field() }}

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Name *</label>
                                <input type="text" id="name" class="form-control" placeholder="Name" name="name" required data-parsley-required-message="Please enter Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" class="form-control" placeholder="Email" name="email" required data-parsley-required-message="Please enter Email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Phone Number *</label>
                                <input type="number" id="phone_number" class="form-control" placeholder="Phone Number" name="phone_number" required data-parsley-required-message="Please enter Phone Number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" id="company_name" class="form-control" placeholder="Company Name" name="company_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="company_address">Company Address</label>
                                <textarea id="company_address" rows="5" class="form-control" name="company_address" placeholder="Company Address"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-warning" data-dismiss="modal">
                        <i class="la la-close"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Save
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection


@push('page_scripts')
    <script type="text/javascript">

        $(function(){

            $("#supplierForm").submit(function(e){
                e.preventDefault();
                var formData = $("#supplierForm").serialize();

                $.ajax({
                    url: "{{ URL::route('admin_inventory_purchase_store_supplier') }}",
                    dataType: 'json',
                    type: 'POST',
                    data: formData,
                    success:function(response){
                        if (response.status) {

                            $("#addSupplierModal").modal('hide');
                            toastr.success(response.message, 'Success', {timeOut: 2000});
                            $("#supplierForm")[0].reset();
                            $('#supplierForm').parsley().reset();

                            // Select2 : Create a DOM Option and pre-select by default
                            // var newOption = new Option(data.text, data.id, true, true);
                            // $('#select2').append(newOption).trigger('change');

                            // OR, working in IE8
                            var optionText = response.data.name + ' - ' + response.data.companyName;
                            var newOption = new Option(optionText, response.data.unqId, true, true);
                            $(newOption).html(optionText); // jquerify the DOM object 'newOption' so we can use the html method
                            $("#supplier").prepend(newOption);

                        } else{

                            if(response.errors) {
                                if(response.errors.name){
                                    toastr.error(response.errors.name[0], 'Error !', {timeOut: 2000});
                                }
                                if(response.errors.email){
                                    toastr.error(response.errors.email[0], 'Error !', {timeOut: 2000});
                                }
                                if(response.errors.phone_number){
                                    toastr.error(response.errors.phone_number[0], 'Error !', {timeOut: 2000});
                                }
                            }
                        }
                    },
                    error:function(response) {
                        console.log('inisde ajax error handler');
                    }
                });
            });

        });

    </script>
@endpush