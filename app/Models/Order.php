<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;


    // In Order.php model

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
<<<<<<< HEAD
=======
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
>>>>>>> 640fb24d4c235f6b8627a0ba651738db811bc91b

}
