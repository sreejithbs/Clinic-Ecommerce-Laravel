<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;

use App\Models\Admin\Product;

class InventoryLog extends Model
{
	use SoftDeletes;  // enable Soft Delete
    use UuidTrait;  // to assign Uuid value as default

	protected $table = 'inventory_logs';

	/**
	 * The products that belong to the inventory_logs.
	 */
	public function products()
	{
	    return $this->belongsToMany(Product::class, 'inventory_purchase_product', 'inventoryPurchaseId', 'productId')
	    ->withPivot('quantity', 'subTotalPrice')
	    ->withTimestamps();
	}
}