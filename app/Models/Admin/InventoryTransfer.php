<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;
use Carbon\Carbon;

use App\Models\Admin\Product;

class InventoryTransfer extends Model
{
	use SoftDeletes;  // enable Soft Delete
    use UuidTrait;  // to assign Uuid value as default

	protected $table = 'inventory_transfers';

	public static function createTimestampFromDateTime($dateTime)
	{
		return Carbon::createFromFormat('d/m/Y H:i A', $dateTime)->toDateTimeString();
	}

	/**
	 * The products that belong to the inventory_transfers.
	 */
	public function products()
	{
	    return $this->belongsToMany(Product::class, 'inventory_transfer_product', 'inventoryTransferId', 'productId')
	    ->withPivot('quantity', 'subTotalPrice')
	    ->withTimestamps();
	}
}
