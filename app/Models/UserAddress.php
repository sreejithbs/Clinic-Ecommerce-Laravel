<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
	use SoftDeletes;  // enable Soft Delete

	protected $table = 'user_addresses';
}
