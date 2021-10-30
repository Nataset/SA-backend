<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //    $item = new Item;
        //    $item->name = "TEST";
        //    $item->amount = 10;
        //    $item->price = 200.50;
        //    $item->min_item = 2;
        //    $item->save();

        Item::factory()->count(3)->create();
    }
}
