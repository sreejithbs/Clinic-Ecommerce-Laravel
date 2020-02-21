<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Traits\UuidTrait;

class Product extends Model
{
	use SoftDeletes;  // enable Soft Delete
    use UuidTrait;  // to assign Uuid value as default

	protected $table = 'products';

	use HasSlug;
    
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relation
    public function product_images(){
        return $this->hasMany(ProductImage::class, 'productId');
    }

}