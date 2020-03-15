<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;
use Carbon\Carbon;

class InventoryLog extends Model
{
	use SoftDeletes;  // enable Soft Delete
    use UuidTrait;  // to assign Uuid value as default

	protected $table = 'inventory_logs';

	public function getDateTimeAttribute()
	{
		return Carbon::parse($this->attributes['dateTime'])->format('d/m/Y');
	}
}