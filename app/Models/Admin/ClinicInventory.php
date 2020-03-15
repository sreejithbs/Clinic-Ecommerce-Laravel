<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;

use App\Models\Admin\Product;

class ClinicInventory extends Model
{
	use SoftDeletes;  // enable Soft Delete
	use UuidTrait;  // to assign Uuid value as default

	protected $table = 'clinic_inventories';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'productId', 'clinicId',
	];

	/**
	 * The product that belong to the clinic inventory.
	 */
	public function product(){
	    return $this->belongsTo(Product::class, 'productId');
	}
}