<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Admin Demo',
            'email' => 'admin@demo.com',
            'password' => bcrypt('admin@123'),
            'isSuper' => 1
        ]);
    }
}