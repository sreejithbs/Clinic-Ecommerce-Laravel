<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = new User;
    	$user->name = 'User Demo';
    	$user->email = 'user@demo.com';
    	$user->password = bcrypt('user@123');
    	$user->save();
    }
}
