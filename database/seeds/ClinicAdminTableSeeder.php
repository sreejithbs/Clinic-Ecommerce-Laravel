<?php

use Illuminate\Database\Seeder;
use App\Models\Clinic;

class ClinicAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$clinic_admin = new Clinic;
    	$clinic_admin->name = 'Clinic Demo';
    	$clinic_admin->email = 'clinic@demo.com';
    	$clinic_admin->password = bcrypt('clinic@123');
    	$clinic_admin->save();
    }
}
