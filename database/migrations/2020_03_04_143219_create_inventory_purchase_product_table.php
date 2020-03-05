<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryPurchaseProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_purchase_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('productId');
            $table->unsignedBigInteger('inventoryPurchaseId');
            $table->integer('quantity');
            $table->decimal('subTotalPrice', 10, 2);
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('inventory_purchase_product', function (Blueprint $table) {
            $table->foreign('productId')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('inventoryPurchaseId')->references('id')->on('inventory_purchases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_purchase_product');
    }
}
