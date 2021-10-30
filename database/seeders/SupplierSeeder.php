<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\Item;

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


        $supplierNumber = 0;
        for ($x = 1; $x <= 3; $x++) {
            $n = rand(1, 3);
            for ($y = 1; $y <= $n; $y++) {
                $tmp = $supplierNumber;
                $supplierNumber = rand(1, 3);
                if ($tmp !== $supplierNumber) {
                    $item = Item::findOrFail($x);
                    $item->suppliers()->attach($supplierNumber);
                    $item->save();
                }
            }
        }
    }
}
