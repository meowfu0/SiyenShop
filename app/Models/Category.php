<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    // Define the relationship: A category has many products
    public function products()
    {
        return $this->hasMany(Product::class); // This assumes you have a Product model
    }
}
