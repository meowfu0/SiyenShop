<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'ratings',
        'review_text',
    ];



    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
