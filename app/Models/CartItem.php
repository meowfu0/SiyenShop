<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public $timestamps = false;  // Disable automatic timestamps
    protected $fillable = ['cart_id', 'product_id', 'quantity'];


    use HasFactory;
}
