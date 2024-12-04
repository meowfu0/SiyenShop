<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeniedOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'denial_reason',
        'denial_comment',
    ];
}
