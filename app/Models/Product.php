<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['category_id','status_id','shop_id','product_name','product_decription','product_image','supplier_price', 'retail_price',  'sales_count','stocks','created_at','modified_at', 'deleted_at'];

    use HasFactory;

    public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

public function organization()
{
    return $this->belongsTo(Shop::class, 'shop_id');


}
public function Status()
{
    return $this->belongsTo(Status::class, 'status_id');


}

public function variants()
{
    return $this->hasMany(ProductVariant::class, 'product_id');
}

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }


public function images()
{
    return $this->hasMany(Image::class);
 }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}


