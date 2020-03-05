<tr>
	<td class="text-center">
		{{ $product->title }}
	</td>
	<td class="text-center">
		$ <span class="unit_price">
			{{ $product->sellingPrice }}
		</span>
	</td>
	<td class="text-center">
	    <div class="badge badge-pill badge-info">
	    	{{ $product->stockQuantity }}
	    </div>
	</td>
	<td>
		<div class="card-body">
			<input type="number" class="form-control quantity" placeholder="Product Quantity" name="quantity[{{ $product->unqId }}]" min="1" required data-parsley-required-message="Please enter Product Quantity">
		</div>
	</td>
	<td class="text-center">
		$ <span class="unit_sub_total">0</span>
	</td>
	<td>
		<button type="button" class="btn btn-icon btn-danger mr-1 delProdBtn">
			<i class="ft-x"></i>
		</button>
	</td>
</tr>