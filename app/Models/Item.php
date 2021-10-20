<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_item')->withTimestamps();
    }
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'item_supplier')->withTimestamps();
    }
}
