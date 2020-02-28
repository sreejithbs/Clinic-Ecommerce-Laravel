<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('unqId')->index();
            $table->unsignedBigInteger('createdByAdminId')->nullable();
            $table->unsignedBigInteger('supplierId')->nullable();
            $table->unsignedBigInteger('productId');
            $table->integer('quantity');
            $table->decimal('totalPrice', 10, 2);
            $table->timestamp('dateTime');
            $table->longText('notes');
            $table->string('attachment')->nullable();
            $table->enum('paymentMode', ['cash', 'credit']);
            $table->enum('purchaseStatus', ['ordered', 'pending', 'received']);
            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('inventory_purchases', function (Blueprint $table) {
            $table->foreign('createdByAdminId')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('supplierId')->references('id')->on('suppliers')->onDelete('set null');
            $table->foreign('productId')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_purchases');
    }
}
