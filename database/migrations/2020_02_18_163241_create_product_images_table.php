<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('productId');
            $table->string('originalImagePath');
            $table->string('smallImagePath');
            $table->string('mediumImagePath');
            $table->string('largeImagePath');
            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('product_images', function (Blueprint $table) {
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
        Schema::dropIfExists('product_images');
    }
}
