<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserOrder;

class UserOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create new UserOrder
        $order = new UserOrder;
        $order->user_id = 1;
        $order->total_order_price = 0;
        $order->receipt_image = null;
        $order->status = 'pending';
        $order->save();

        // attach userOrder to item in user_order_item table
        $order->items()->attach(1, ['amount' => 1, 'total_item_price' => 500]);
        $order->save();

    }
}
