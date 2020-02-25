<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Admin\Product;

class ProductImage extends Model
{
	use SoftDeletes;  // enable Soft Delete

	protected $table = 'product_images';

	/**
	 * Relation
	 */
	public function product(){
	    return $this->belongsTo(Product::class);
	}
}