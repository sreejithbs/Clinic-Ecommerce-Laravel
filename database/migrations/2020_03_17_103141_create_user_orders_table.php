<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('unqId')->index();
            $table->boolean('isWalkinCustomer')->default(1)->comment('0: Registered | 1: Walkin');
            $table->unsignedBigInteger('userId')->nullable();
            $table->string('orderRefNum', 50)->unique();
            $table->timestamp('dateTime')->useCurrent();
            $table->decimal('grossTotal', 10, 2);
            $table->decimal('netTotal', 10, 2);
            $table->unsignedBigInteger('customerAddressId')->nullable();
            // $table->string('couponCode')->nullable();
            // $table->decimal('discount', 6, 2)->nullable();
            $table->longText('notes')->nullable();
            $table->enum('orderStatus', ['processing', 'completed', 'failed'])->default('processing');
            $table->enum('paymentStatus', ['processing', 'completed', 'failed'])->default('processing');
            $table->enum('saleChannel', ['ecommerce', 'clinic'])->default('ecommerce');
            $table->unsignedBigInteger('saleClinicId')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('user_orders', function (Blueprint $table) {
            $table->foreign('userId')->references('id')->on('users')->onDelete('set null');
            $table->foreign('customerAddressId')->references('id')->on('user_addresses');
            $table->foreign('saleClinicId')->references('id')->on('clinic_admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_orders');
    }
}
