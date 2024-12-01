<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Shop;

class GCashInfo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'user_id', 'shop_id'
    ];
}

