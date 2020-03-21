<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;
use Carbon\Carbon;

use App\Models\Admin\Product;
use App\Models\Clinic;
use App\Models\User;

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
       return Carbon::parse($this->attributes['dateTime'])->format('d/m/Y g:i A');
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

    /**
     * The user_order that belong to the clinic.
     */
    public function created_clinic(){
        return $this->belongsTo(Clinic::class, 'saleClinicId');
    }

    /**
     * The user_order that belong to the customer.
     */
    public function customer(){
        return $this->belongsTo(User::class, 'userId');
    }
}