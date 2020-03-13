<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('unqId')->index();
            $table->unsignedBigInteger('productId');
            $table->string('refNum', 50)->default('-');
            $table->string('logEvent');
            $table->tinyInteger('eventCode');
            $table->timestamp('dateTime');
            $table->integer('openingQty');
            $table->integer('quantity');
            $table->integer('closingQty');
            $table->string('relatedEntryModel');
            $table->unsignedBigInteger('relatedEntryModelId');
            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('inventory_logs', function (Blueprint $table) {
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
        Schema::dropIfExists('inventory_logs');
    }
}