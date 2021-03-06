<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_supplier')->withTimestamps();
    }
    public function restockOrders()
    {
        return $this->hasMany(RestockOrder::class);
    }
}
