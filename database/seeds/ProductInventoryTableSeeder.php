<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Product;
use App\Models\Admin\ProductImage;
use App\Models\Admin\InventoryLog;

class ProductInventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->createdByAdminId = 1;
        $product->title = 'Demo Face Gel';
        $product->slug = 'demo-face-gel';
        $product->description = 'This is a test description for Face Gel. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.';
        $product->remarks = 'This is a test remark';
        $product->dateTime = '2020-02-01 05:30:00';
        $product->initialStockQuantity = $product->stockQuantity = 110;
        $product->sellingPrice = 499.00;
        $product->save();

        $product_image = new ProductImage();
        $product_image->productId = $product->id;
        $product_image->originalImagePath = '/uploads/products/1584200000-ageless.png';
        $product_image->save();

        $product_image = new ProductImage();
        $product_image->productId = $product->id;
        $product_image->originalImagePath = '/uploads/products/1584200000-anti-wrinkle-cream.jpg';
        $product_image->save();

        $inventory_log = new InventoryLog();
        $inventory_log->productId = $product->id;
        $inventory_log->refNum = '-';
        $inventory_log->logEvent = 'Initial Inventory Added';
        $inventory_log->eventCode = 0;
        $inventory_log->dateTime = '2020-02-01 05:30:00';
        $inventory_log->openingQty = 0;
        $inventory_log->quantity = $inventory_log->closingQty = $product->stockQuantity;
        $inventory_log->relatedEntryModel = 'App\Models\Admin\Product';
        $inventory_log->relatedEntryModelId = 1;
        $inventory_log->save();
    }
}
