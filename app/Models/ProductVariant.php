<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'size', 'stock'];

    public function productvariant()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function product()
{
    return $this->belongsTo(Product::class);
}
}
