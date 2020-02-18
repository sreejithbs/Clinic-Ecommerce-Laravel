<?php

namespace App\Models\Admin\ProductImage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
	use SoftDeletes;  // enable Soft Delete

	protected $table = 'product_images';

}