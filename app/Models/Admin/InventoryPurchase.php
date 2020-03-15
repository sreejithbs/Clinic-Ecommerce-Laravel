<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;
use Carbon\Carbon;

use App\Models\Admin;
use App\Models\Admin\Product;

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
	 * The inventory_purchases that belong to the products.
	 */
	public function product(){
	    return $this->belongsTo(Product::class, 'productId');
	}

	/**
	 * The inventory_purchases that belong to the admin.
	 */
	public function created_admin(){
	    return $this->belongsTo(Admin::class, 'createdByAdminId');
	}
}