<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'shop_id',
        'status_id',
        'visibility_id',
        'product_name',
        'product_decription',
        'product_image',
        'supplier_price',
        'retail_price',
        'sales_count',
        'stocks',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function visibility()
    {
        return $this->belongsTo(Visibility::class, 'visibility_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    
}
