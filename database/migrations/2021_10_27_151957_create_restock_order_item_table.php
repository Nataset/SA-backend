<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestockOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restock_order_item', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->float('total_item_price');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('restock_order_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('order_id')->references('id')->on('restock_orders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restock_order_item');
    }
}
