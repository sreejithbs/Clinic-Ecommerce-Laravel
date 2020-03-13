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
            $table->string('orderRefNum', 50)->unique();
            $table->string('orderNumber')->nullable();
            $table->timestamp('dateTime');
            $table->decimal('totalPrice', 10, 2);
            $table->longText('notes')->nullable();
            $table->enum('paymentMode', ['cash', 'credit', 'others']);
            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('inventory_purchases', function (Blueprint $table) {
            $table->foreign('createdByAdminId')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('supplierId')->references('id')->on('suppliers')->onDelete('set null');
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
