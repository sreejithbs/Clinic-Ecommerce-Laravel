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
        $product->description = 'This is a test description for Face Gel';
        $product->remarks = 'No remarks to add';
        $product->initialStockQuantity = $product->stockQuantity = 101;
        $product->regularPrice = 599.00;
        $product->sellingPrice = 499.00;
        $product->save();

        $product_image = new ProductImage();
        $product_image->productId = $product->id;
        $product_image->originalImagePath = '/uploads/products/1584209834-ageless-derma-stem-cell-and-peptide-anti-wrinkle-cream-1-280x300.png';
        $product_image->save();

        $product_image = new ProductImage();
        $product_image->productId = $product->id;
        $product_image->originalImagePath = '/uploads/products/1584209834-orig.jpg';
        $product_image->save();

        $inventory_log = new InventoryLog();
        $inventory_log->productId = $product->id;
        $inventory_log->refNum = '-';
        $inventory_log->logEvent = 'Initial Inventory Added';
        $inventory_log->eventCode = 0;
        $inventory_log->dateTime = '2020-03-14 18:17:14';
        $inventory_log->openingQty = 0;
        $inventory_log->quantity = $inventory_log->closingQty = 101;
        $inventory_log->relatedEntryModel = 'App\Models\Admin\Product';
        $inventory_log->relatedEntryModelId = 1;
        $inventory_log->save();
    }
}
