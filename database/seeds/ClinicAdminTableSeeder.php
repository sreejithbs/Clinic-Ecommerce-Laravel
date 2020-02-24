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
    	Clinic::create([
            'name' => 'Clinic Demo',
            'email' => 'clinic@demo.com',
            'password' => bcrypt('clinic@123')
        ]);
    }
}
