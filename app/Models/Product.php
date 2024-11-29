<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'shop_id', 'status_id', 'visibility_id',
        'product_name', 'product_description', 'product_image',
        'supplier_price', 'retail_price', 'sales_count', 'stocks',
        'created_at', 'modified_at', 'deleted_at'
    ];

    // Disable automatic timestamp handling for 'updated_at'
    public $timestamps = true;

    const UPDATED_AT = 'modified_at';

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function visibility()
    {
        return $this->belongsTo(Visibility::class);
    }
    
}
