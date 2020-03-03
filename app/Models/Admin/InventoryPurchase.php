<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;
use Carbon\Carbon;

class InventoryPurchase extends Model
{
	use SoftDeletes;  // enable Soft Delete
    use UuidTrait;  // to assign Uuid value as default

	protected $table = 'inventory_purchases';

	public static function createTimestampFromDateTime($dateTime)
	{
		return Carbon::createFromFormat('d/m/Y H:i A', $dateTime)->toDateTimeString();
	}
}
