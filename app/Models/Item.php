<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    public function userOrders()
    {
        return $this->belongsToMany(UserOrder::class, 'user_order_item')->withPivot('amount', 'total_item_price')->withTimestamps();
    }
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'item_supplier')->withTimestamps();
    }
    public function restockOrders()
    {
        return $this->belongsToMany(RestockOrder::class, 'restock_order_item')->withPivot('amount', 'buyPrice', 'total_item_price')->withTimestamps();
    }
}
