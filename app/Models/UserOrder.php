<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;
use Carbon\Carbon;

use App\Models\Admin\Product;

class UserOrder extends Model
{
	use SoftDeletes;  // enable Soft Delete
    use UuidTrait;  // to assign Uuid value as default

	protected $table = 'user_orders';

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
       return Carbon::parse($this->attributes['dateTime'])->format('d/m/Y H:i A');
    }

	/**
	 * The products that belong to the user_order.
	 */
	public function products()
	{
	    return $this->belongsToMany(Product::class, 'user_order_products', 'userOrderId', 'productId')
	    ->withPivot('quantity', 'subTotal')
	    ->withTimestamps();
	}
}
