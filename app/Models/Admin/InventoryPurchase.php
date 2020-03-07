<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;
use Carbon\Carbon;

use App\Models\Admin\Product;
use App\Models\Admin\Supplier;

class InventoryPurchase extends Model
{
	use SoftDeletes;  // enable Soft Delete
    use UuidTrait;  // to assign Uuid value as default

	protected $table = 'inventory_purchases';

	public static function createTimestampFromDateTime($dateTime)
	{
		return Carbon::createFromFormat('d/m/Y H:i A', $dateTime)->toDateTimeString();
	}

	public function getDateTimeAttribute()
	{ 
	   return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
	}

	/**
	 * The products that belong to the inventory_purchases.
	 */
	public function products()
	{
	    return $this->belongsToMany(Product::class, 'inventory_purchase_product', 'inventoryPurchaseId', 'productId')
	    ->withPivot('quantity', 'subTotalPrice')
	    ->withTimestamps();
	}

	/**
	 * Fetch Supplier
	 */
	public function supplier()
	{
	    return $this->belongsTo(Supplier::class, 'supplierId');
	}
}
