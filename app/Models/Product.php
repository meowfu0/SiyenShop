<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // Define the inverse relationship with OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}
