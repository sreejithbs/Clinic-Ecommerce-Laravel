<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Traits\UuidTrait;
use Carbon\Carbon;

use App\Models\Admin;
use App\Models\Admin\ProductImage;
use App\Models\Admin\InventoryLog;
use App\Models\Admin\InventoryPurchase;
use App\Models\Admin\InventoryTransfer;

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
     * The product_images that belong to the products.
     */
    public function product_images(){
        return $this->hasMany(ProductImage::class, 'productId');
    }

    /**
     * The products that belong to the admin.
     */
    public function created_admin(){
        return $this->belongsTo(Admin::class, 'createdByAdminId');
    }

    /**
     * The inventory_purchases that belong to the products.
     */
    public function inventory_purchases(){
        return $this->hasMany(InventoryPurchase::class, 'productId');
    }

    /**
     * The inventory_transfers that belong to the products.
     */
    public function inventory_transfers(){
        return $this->hasMany(InventoryPurchase::class, 'productId');
    }

    /**
     * The inventory_logs that belong to the products.
     */
    public function inventory_logs(){
        return $this->hasMany(InventoryLog::class, 'productId');
    }
}