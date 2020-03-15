<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('unqId')->index();
            $table->unsignedBigInteger('createdByAdminId')->nullable();
            $table->unsignedBigInteger('productId');
            $table->unsignedBigInteger('clinicId')->nullable()->comment('clinic, where product to be transferred');
            $table->string('transferRefNum', 50)->unique();
            $table->string('transferNumber')->nullable();
            $table->integer('quantity');
            $table->timestamp('dateTime');
            $table->decimal('totalPrice', 10, 2);
            $table->longText('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('inventory_transfers', function (Blueprint $table) {
            $table->foreign('createdByAdminId')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('productId')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('clinicId')->references('id')->on('clinic_admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_transfers');
    }
}
