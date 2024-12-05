<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Relationship to ProductVariant
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    // Relationship to Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
