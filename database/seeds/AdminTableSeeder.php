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
        $admin = new Admin;
        $admin->name = 'Admin Demo';
        $admin->email = 'admin@demo.com';
        $admin->password = bcrypt('admin@123');
        $admin->save();
    }
}
