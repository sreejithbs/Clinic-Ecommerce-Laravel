<?php

use Illuminate\Database\Seeder;
use App\Models\Clinic;
use App\Models\Admin\ClinicProfile;

class ClinicAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$clinic = Clinic::create([
            'name' => 'Clinic Demo',
            'email' => 'clinic@demo.com',
            'password' => bcrypt('clinic@123'),
            'status' => 'active',
            'hasFirstTimeActivated' => 1
        ]);

        if($clinic){
            $clinic_profile = new ClinicProfile();
            $clinic_profile->createdByAdminId = 1;
            $clinic_profile->clinicRefNum = 'clinic#67b432c3';
            $clinic_profile->clinicName = 'Demo Clinic';
            $clinic_profile->clinicAddress = 'Test address, Test Street, CA';
            $clinic_profile->phoneNumber = '9219592195';
            $clinic_profile->secondaryEmail = 'demo_secondary@gmail.com';
            $clinic_profile->bankAcNumber = '12345678';
            $clinic_profile->bankAcHolderName = 'Demo Name';
            $clinic_profile->bankName = 'Demo Bank';
            $clinic_profile->bankCode = 'DEMO000336';
            $clinic_profile->bankAddress = 'Demo bank address, Demo Street, CA';
            $clinic_profile->commissionPercentage = 10.00;
            $clinic->clinic_profile()->save($clinic_profile);
        }
    }
}
