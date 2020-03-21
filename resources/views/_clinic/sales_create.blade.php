@extends('_clinic.partials.master')
@section('page_title', 'Add new Sale Order | Inner Beauty')
@section('page_heading', 'Add new Sale Order')

@section('page_styles')
    <style type="text/css">
        .hideDiv{
            display: none;
        }
    </style>
@stop

@section('content')

<section id="basic-form-layouts">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">

                        <form method="post" action="{{ route('clinic_sales_store') }}" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="" data-parsley-excluded="input[type=hidden], [disabled], :hidden" autocomplete="off">
                        	{{ csrf_field() }}

                            <div class="form-body">
                                <h4 class="form-section">
                                    <i class="ft-package"></i> Order Details
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="product">Select Product *</label>
                                    <div class="col-md-9">
                                        <select id="product" class="form-control select2">
                                            <option value="">-- Select an option --</option>
                                            @foreach($clinic_inventories as $clinic_inventory)
                                                <option value="{{ $clinic_inventory->product->unqId }}" data-prod_price="{{ $clinic_inventory->product->sellingPrice }}">
                                                    {{ $clinic_inventory->product->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Unit Price</th>
                                                <th>Available Stock</th>
                                                <th>Quantity</th>
                                                <th>Unit SubTotal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="appendDiv">
                                            <tr class="no-data bg-pink bg-lighten-5">
                                                <td colspan="6">-- No Products data added --</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="total_price">Total Price</label>
                                    <div class="col-md-2">
                                        <h2 class="success">
                                            $<span id="total_price">0</span>
                                        </h2>
                                    </div>
                                </div>

                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="notes">Remarks</label>
                                    <div class="col-md-9">
                                        <textarea id="notes" rows="5" class="form-control" name="notes" placeholder="Remarks"></textarea>
                                    </div>
                                </div>

                                <h4 class="form-section">
                                    <i class="ft-user"></i> Customer Info
                                </h4>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control">Choose Customer Type *</label>
                                    <div class="col-md-9">
                                        <div class="input-group skin skin-square">
                                            <div class="d-inline-block custom-control custom-radio" style="padding-left: 0px;">
                                                <input type="radio" name="customer_type" class="custom-control-input customer_type" id="walkin" value="walkin" checked required data-parsley-required-message="Please choose Customer Type" data-parsley-errors-container="#mode_errorDiv">
                                                <label for="walkin">Walk-in Customer</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="customer_type" class="custom-control-input customer_type" id="registered" value="registered">
                                                <label for="registered">Registered Customer</label>
                                            </div>
                                        </div>
                                        <div id="mode_errorDiv"></div>
                                    </div>
                                </div>
                                <!-- Toggle Div -->
                                <div class="form-group row hideDiv last" id="registeredDiv">
                                    <label class="col-md-3 label-control" for="user">Select User *</label>
                                    <div class="col-md-9">
                                        <select id="user" class="form-control select2" name="user" required data-parsley-required-message="Please Select an user" data-parsley-errors-container="#user_errorDiv" style="width: 100%">
                                            <option value="">-- Select an option --</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->unqId }}"> {{ $user->name }} - {{ $user->email }}</option>
                                            @endforeach
                                        </select>
                                        <div id="user_errorDiv"></div>
                                    </div>
                                </div>
                                <!-- Toggle Div -->
                            </div>
                            <div class="form-actions">
                                <a href="{{ route('clinic_sales_list') }}" class="btn btn-warning mr-1">
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

        function recalculatePrices(){
            var mainTotal = 0;
            $("#total_price").text('0');
            $(".appendDiv tr").not('.no-data').each(function(){
                var subTotal = 0;
                var unit_qty = parseInt( $(this).find('.quantity').val() );
                var unit_price = parseFloat( $(this).find('.unit_price').text() );

                if(!isNaN(unit_qty)){
                    subTotal = unit_price * unit_qty;
                    $(this).find('.unit_sub_total').text(subTotal);
                    mainTotal += subTotal;
                    $("#total_price").text(mainTotal);
                }
            });
        }

        $(function(){

            // Select product from product list
            $('body').on('change', '#product', function(){
                var $elm = $(this).find('option:selected');
                if($elm.val() == ""){
                  toastr.error('Please select a Product', 'Error !', {timeOut: 2000});
                  return;
                }
                $.ajax({
                    url: "{{ URL::route('clinic_inventory_append_product') }}",
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        'product' : $elm.val()
                    },
                    success:function(response){
                        if (response.status) {

                            $elm.prop('disabled', true);
                            $('#product').select2().val('').trigger('change.select2');

                            $(".no-data").remove();
                            $(".appendDiv").append(response.renderHtml);
                        }
                    },
                    error:function(response) {
                        console.log('inisde ajax error handler');
                    }
                });
            });

            // Product Quantity Change
            $('body').on('change', '.quantity', function(){
                if(isNaN( $(this).val() )){
                    toastr.error('Please enter a valid quantity', 'Error !', {timeOut: 2000});
                    return;
                }
                recalculatePrices();
            });

            // Product Remove
            $('body').on('click', '.delProdBtn', function(){

                var prod_unq_id = $(this).attr('data-prod_unq_id');
                $(this).parents('tr').fadeOut(300, function(){
                    $(this).remove();
                    if($(".appendDiv tr").length == 0){
                        $(".appendDiv").append('<tr class="no-data bg-pink bg-lighten-5"><td colspan="6">-- No Products data added --</td></tr>');
                    }
                    $('#product option[value="' + prod_unq_id + '"]').prop('disabled', false);
                    $('#product').select2();

                    recalculatePrices();
                });
            });

            $("input[name='customer_type']").on('ifChanged', function (e) {
                var isChecked = e.currentTarget.checked;
                if (isChecked == true) {
                    if($(this).val() == 'walkin'){
                        $("#registeredDiv").addClass('hideDiv');
                    } else if($(this).val() == 'registered'){
                        $("#user").val('').trigger('change.select2');
                        $("#registeredDiv").removeClass('hideDiv');
                    }
                }
            });
        });

    </script>
@endpush