<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestockOrder extends Model
{
    use HasFactory;

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function items()
    {
        return $this->belongsToMany(Item::class, 'restock_order_item')->withPivot('amount', 'buyPrice', 'total_item_price')->withTimestamps();
    }
}
