<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	// // Ask for db migration refresh, default is no
     //    if ($this->command->confirm('Do you wish to delete and re-create all existing tables before seeding ? It will clear all old data.')) {
     //        $this->command->call('migrate:refresh');
     //        $this->command->warn("Data cleared successfully. Starting from blank database.");
     //    }

    	$this->call(AdminTableSeeder::class);
        $this->call(ClinicAdminTableSeeder::class);
    	$this->call(UserTableSeeder::class);
    }
}
