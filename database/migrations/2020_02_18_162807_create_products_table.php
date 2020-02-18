<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('unqId')->index();
            $table->unsignedBigInteger('createdByAdminId');
            $table->text('title');
            $table->string('slug')->unique();
            $table->longText('description');
            $table->text('remarks');
            $table->integer('stockQuantity')->default(0);
            $table->enum('stockStatus', ['in_stock', 'out_of_stock'])->default('in_stock');
            $table->decimal('regularPrice', 6, 2);
            $table->decimal('sellingPrice', 6, 2);
            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('createdByAdminId')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}