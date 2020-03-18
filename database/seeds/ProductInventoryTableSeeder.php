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
        // Product One
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

        $product_img = new ProductImage();
        $product_img->originalImagePath = '/uploads/products/1584200000-ageless.png';
        $product->product_images()->save($product_img);

        $product_img = new ProductImage();
        $product_img->originalImagePath = '/uploads/products/1584200000-anti-wrinkle-cream.jpg';
        $product->product_images()->save($product_img);

        $inventory_log = new InventoryLog();
        $inventory_log->refNum = '-';
        $inventory_log->logEvent = 'Initial Inventory Added';
        $inventory_log->eventCode = 0;
        $inventory_log->dateTime = '2020-02-01 05:30:00';
        $inventory_log->openingQty = 0;
        $inventory_log->quantity = $inventory_log->closingQty = $product->stockQuantity;
        $inventory_log->relatedEntryModel = 'App\Models\Admin\Product';
        $inventory_log->relatedEntryModelId = 1;
        $product->inventory_logs()->save($inventory_log);

        // Product Two
        $product = new Product();
        $product->createdByAdminId = 1;
        $product->title = 'Womens Collagen';
        $product->slug = 'womens-collagen';
        $product->description = 'Womens Collagen by Fourseas';
        $product->dateTime = '2020-02-18 12:30:00';
        $product->initialStockQuantity = $product->stockQuantity = 10000;
        $product->sellingPrice = 200.00;
        $product->save();

        $product_img = new ProductImage();
        $product_img->originalImagePath = '/uploads/products/1584200000-womens-collagen.jpg';
        $product->product_images()->save($product_img);

        $inventory_log = new InventoryLog();
        $inventory_log->refNum = '-';
        $inventory_log->logEvent = 'Initial Inventory Added';
        $inventory_log->eventCode = 0;
        $inventory_log->dateTime = '2020-02-18 12:30:00';
        $inventory_log->openingQty = 0;
        $inventory_log->quantity = $inventory_log->closingQty = $product->stockQuantity;
        $inventory_log->relatedEntryModel = 'App\Models\Admin\Product';
        $inventory_log->relatedEntryModelId = 2;
        $product->inventory_logs()->save($inventory_log);

        // Product Three
        $product = new Product();
        $product->createdByAdminId = 1;
        $product->title = 'Mens Collagen';
        $product->slug = 'mens-collagen';
        $product->description = 'Mens Collagen by Fourseas';
        $product->dateTime = '2020-02-18 12:30:00';
        $product->initialStockQuantity = $product->stockQuantity = 10000;
        $product->sellingPrice = 100.00;
        $product->save();

        $product_img = new ProductImage();
        $product_img->originalImagePath = '/uploads/products/1584200000-mens-collagen.jpg';
        $product->product_images()->save($product_img);

        $inventory_log = new InventoryLog();
        $inventory_log->refNum = '-';
        $inventory_log->logEvent = 'Initial Inventory Added';
        $inventory_log->eventCode = 0;
        $inventory_log->dateTime = '2020-02-18 12:30:00';
        $inventory_log->openingQty = 0;
        $inventory_log->quantity = $inventory_log->closingQty = $product->stockQuantity;
        $inventory_log->relatedEntryModel = 'App\Models\Admin\Product';
        $inventory_log->relatedEntryModelId = 3;
        $product->inventory_logs()->save($inventory_log);
    }
}
