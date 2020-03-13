<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Traits\UuidTrait;

use App\Models\Admin\ProductImage;
use App\Models\Admin\InventoryPurchase;
use App\Models\Admin\InventoryTransfer;
use App\Models\Admin\InventoryLog;

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
            // ->doNotGenerateSlugsOnUpdate();
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

    /**
     * The product_images that belong to the products.
     */
    public function product_images(){
        return $this->hasMany(ProductImage::class, 'productId');
    }

    /**
     * The inventory_purchases that belong to the products.
     */
    public function inventory_purchases()
    {
        return $this->belongsToMany(InventoryPurchase::class, 'inventory_purchase_product', 'productId', 'inventoryPurchaseId')
        ->withTimestamps();
    }

    /**
     * The inventory_transfers that belong to the products.
     */
    public function inventory_transfers()
    {
        return $this->belongsToMany(InventoryTransfer::class, 'inventory_transfer_product', 'productId', 'inventoryTransferId')
        ->withTimestamps();
    }

    /**
     * The inventory_logs that belong to the products.
     */
    public function inventory_logs(){
        return $this->hasMany(InventoryLog::class, 'productId');
    }
}