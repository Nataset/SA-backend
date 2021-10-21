<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory,SoftDeletes;

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_item')->withPivot('amount')->withTimestamps();
    }
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class,'item_supplier', 'order_restock')->withTimestamps();
    }
}
