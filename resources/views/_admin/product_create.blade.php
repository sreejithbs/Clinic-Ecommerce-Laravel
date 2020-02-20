@extends('_admin.partials.master')
@section('page_title', 'Add New Product | Inner Beauty')
@section('page_heading', 'Add New Product')

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
                        <form method="post" action="{{ route('admin_product_store') }}" enctype="multipart/form-data" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="">
                        	{{ csrf_field() }}
                            <div class="form-body">
                                <h4 class="form-section">
                                	<i class="ft-clipboard"></i> Product Info
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="product_title">Product Title *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="product_title" class="form-control" placeholder="Product Title" name="product_title" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                	<label class="col-md-3 label-control" for="product_desc">Product Description *</label>
                                	<div class="col-md-9">
                                	    <textarea id="product_desc" rows="5" class="form-control" name="product_desc" placeholder="Product Description" required></textarea>
                                	</div>
                                </div>
                                <div class="form-group row last">
                                	<label class="col-md-3 label-control" for="remarks">Remarks</label>
                                	<div class="col-md-9">
                                	    <textarea id="remarks" rows="5" class="form-control" name="remarks" placeholder="Remarks"required></textarea>
                                	</div>
                                </div>

                                <h4 class="form-section">
                                	<i class="ft-image"></i> Product Images
                                </h4>
                                <div class="form-group row last">
                                	<label class="col-md-3 label-control">Select Images *</label>
                                    <div class="col-md-9">
                                    	<div class="controls">
                                    		<input type="file" name="product_imgs[]" class="form-control" accept="image/*" multiple required onchange="previewThumbnail(this);">
                                    		<div class="help-block">
                                    			<small>Only Image files (jpeg, jpg, png, gif) format allowed</small>
                                    		</div>
                                    	</div>
                                    	<div id="previewThumbnailDiv"></div>
                                    </div>
                                </div>

                                <h4 class="form-section">
                                	<i class="ft-clipboard"></i> Product Attributes
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="stock_qty">Stock Quantity *</label>
                                    <div class="col-md-9">
                                        <input type="number" id="stock_qty" class="form-control" placeholder="Stock Quantity" name="stock_qty" min="0" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="regular_price">Regular Price *</label>
                                    <div class="col-md-9">
                                    	<div class="input-group">
                                    		<div class="input-group-prepend">
                                    			<span class="input-group-text">$</span>
                                    		</div>
                                    		<input type="number" id="regular_price" class="form-control" placeholder="Regular Price" name="regular_price" min="0" step="0.01" required>
                                    	</div>
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="selling_price">Selling Price *</label>
                                    <div class="col-md-9">
                                    	<div class="input-group">
                                    		<div class="input-group-prepend">
                                    			<span class="input-group-text">$</span>
                                    		</div>
                                    		<input type="number" id="selling_price" class="form-control" placeholder="Selling Price" name="selling_price" min="0" step="0.01" required>
                                    	</div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn btn-warning mr-1">
                                    <i class="ft-x"></i> Cancel
                                </button>
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

		function previewThumbnail(elm){
			if (elm.files) {
			    var filesAmount = elm.files.length;

			    for (i = 0; i < filesAmount; i++) {
			        var reader = new FileReader();

			        reader.onload = function(event) {
		            	$('<p><img src="' + event.target.result + '" height="200px" width="250px"></p>').appendTo("#previewThumbnailDiv");
			        }

			        reader.readAsDataURL(elm.files[i]);
			    }
			}
		}

	</script>
@endpush

