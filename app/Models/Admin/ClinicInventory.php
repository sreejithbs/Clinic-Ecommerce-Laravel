<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;

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
}