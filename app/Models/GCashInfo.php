<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Shop;

class GCashInfo extends Model
{
    use HasFactory;

    **
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'shop_id', 'gcash_name', 'gcash_number', 'gcash_limit'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }

     /**
     * Relationship to the Role model.
     */
    // The table associated with the model (if it's not the default plural)
    protected $table = 'g_cash_infos';

    // Define the relationship
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id'); // shop_id is the foreign key in g_cash_infos
    }
}

