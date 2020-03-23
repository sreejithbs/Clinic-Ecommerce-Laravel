<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userId');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('phoneNumber');
            $table->text('address1');
            $table->text('address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->integer('zipCode');
            $table->string('country');
            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_addresses');
    }
}
