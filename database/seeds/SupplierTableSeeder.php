<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Supplier;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
            'name' => 'Supplier Tom Demo',
            'email' => 'supplier_tom@demo.com',
            'phoneNumber' => '9219592195',
            'companyName' => "Tom's Manufacturing Company",
            'companyAddress' => "Test street, Test Avenue",
        ]);

        Supplier::create([
            'name' => 'Supplier John Demo',
            'email' => 'supplier_john@demo.com',
            'phoneNumber' => '9219592195',
            'companyName' => "John's & Co Company",
            'companyAddress' => "Test street, Test Avenue",
        ]);
    }
}
