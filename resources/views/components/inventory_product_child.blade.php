<tr>
	<td class="text-center">
		<strong> {{ $product->title }} </strong>
	</td>
	<td class="text-center">
		$ <span class="unit_price">
			{{ $product->sellingPrice }}
		</span>
	</td>
	<td class="text-center">
		<span class="badge badge-success">
			{{ $product->stockQuantity }}
		</span>
	</td>
	<td>
		<input type="number" class="form-control input-sm quantity" placeholder="Quantity" name="quantity[{{ $product->unqId }}]" min="1" required data-parsley-required-message="Please enter Qty">
	</td>
	<td class="text-center">
		$ <span class="unit_sub_total">0</span>
	</td>
	<td>
		<button type="button" class="btn btn-sm btn-danger delProdBtn" data-prod_unq_id="{{ $product->unqId }}">
			<i class="ft-trash-2"></i>
		</button>
	</td>
</tr>