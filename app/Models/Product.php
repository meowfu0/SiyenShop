<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    protected $fillable = ['category_id','status_id','shop_id','product_name','product_decription','product_image','supplier_price', 'retail_price',  'sales_count','stocks','created_at','modified_at', 'deleted_at'];

    use HasFactory;
    


    // Disable automatic timestamp handling for 'updated_at'
    public $timestamps = true;

    const UPDATED_AT = 'modified_at';

    // Relationships

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }



    public function visibility()
    {
        return $this->belongsTo(Visibility::class);
    }
    

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

    // Define the relationship with Review
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }


}


