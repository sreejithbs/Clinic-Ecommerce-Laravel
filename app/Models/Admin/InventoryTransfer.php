<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;
use Carbon\Carbon;

use App\Models\Admin;
use App\Models\Clinic;
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

	public function getDateTimeAttribute()
	{
	   return Carbon::parse($this->attributes['dateTime'])->format('d/m/Y');
	}

	/**
	 * The inventory_transfers that belong to the products.
	 */
	public function product(){
	    return $this->belongsTo(Product::class, 'productId');
	}

	/**
	 * The inventory_transfers that belong to the admin.
	 */
	public function created_admin(){
	    return $this->belongsTo(Admin::class, 'createdByAdminId');
	}

	/**
	 * The inventory_transfers that belong to the clinic.
	 */
	public function clinic(){
	    return $this->belongsTo(Clinic::class, 'clinicId');
	}
}