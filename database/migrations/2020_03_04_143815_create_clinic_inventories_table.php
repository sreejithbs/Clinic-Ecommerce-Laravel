<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('unqId')->index();
            $table->unsignedBigInteger('clinicId')->nullable();
            $table->unsignedBigInteger('productId');
            $table->integer('stockQuantity')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('clinic_inventories', function (Blueprint $table) {
            $table->foreign('clinicId')->references('id')->on('clinic_admins')->onDelete('set null');
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
        Schema::dropIfExists('clinic_inventories');
    }
}