<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $supplier = new Supplier;
        $supplier->name = 'Supplier1';
        $supplier->save();
        $supplier = new Supplier;
        $supplier->name = 'Supplier2';
        $supplier->save();
        $supplier = new Supplier;
        $supplier->name = 'Supplier3';
        $supplier->save();
    }
}
