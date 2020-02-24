<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicProfilestable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('createdByAdminId');
            $table->unsignedBigInteger('clinicAdminId');
            $table->string('clinicReferenceId', 20);
            $table->text('clinicName');
            $table->longText('clinicAddress');
            $table->string('phoneNumber', 20);
            $table->string('secondaryEmail', 50);
            $table->string('bankAcNumber', 50);
            $table->string('bankAcHolderName');
            $table->string('bankName');
            $table->string('bankCode', 50);
            $table->longText('bankAddress');
            $table->decimal('commissionPercentage', 8, 2)->default('10.00');
            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('clinic_profiles', function (Blueprint $table) {
            $table->foreign('createdByAdminId')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('clinicAdminId')->references('id')->on('clinic_admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_profiles');
    }
}
