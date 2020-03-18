<tr class="bg-teal bg-lighten-4">
	<td> {{ $clinic_inventory->product->title }} </td>
	<td>
		$ <span class="unit_price"> {{ $clinic_inventory->product->sellingPrice }} </span>
	</td>
	<td>
		<span class="badge badge-success"> {{ $clinic_inventory->stockQuantity }} </span>
	</td>
	<td>
		<input type="number" class="form-control input-sm quantity" placeholder="Qty" name="quantity[{{ $clinic_inventory->product->unqId }}]" min="1" max="{{ $clinic_inventory->stockQuantity }}" required data-parsley-required-message="Please enter Qty">
	</td>
	<td>
		$ <span class="unit_sub_total">0</span>
	</td>
	<td>
		<button type="button" class="btn btn-sm btn-danger delProdBtn" data-prod_unq_id="{{ $clinic_inventory->product->unqId }}">
			<i class="ft-trash-2"></i>
		</button>
	</td>
</tr>