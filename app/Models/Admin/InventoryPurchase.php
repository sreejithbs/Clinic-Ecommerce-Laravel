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

	/**
     * List the fields that would automatically be appended
     *
     * @var array
     */
    protected $appends = ['date'];

    public function getDateAttribute($event_date)
    {
        return Carbon::parse($this->attributes['dateTime'])->format('d/m/Y');
    }

    public function getDateTimeAttribute()
    {
       return Carbon::parse($this->attributes['dateTime'])->format('d/m/Y g:i A');
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