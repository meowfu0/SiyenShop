<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Status;
use App\Models\User;
use App\Models\GCashInfo;


class Shop extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = 'shops';
     public $timestamps = false;

     
    protected $fillable = [
        'shop_name', 'shop_description', 'shop_logo', 'user_id', 'course_id', 'status_id'
    ];

    
    public function course()
    {
        return $this->belongsTo(Course::class); 
    }

    public function status()
    {
        return $this->belongsTo(Status::class );
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function g_cash_info()
    {
        return $this->belongsTo(GCashInfo::class, 'shop_id'); // Assuming 'shop_id' is the foreign key in `g_cash_infos`
    }

    public function managers()
{
    return $this->belongsToMany(User::class)
                ->withPivot('gcash_name', 'gcash_number', 'gcash_limit')  // Attach extra fields
                ->withTimestamps();
}

public function businessManagers()
{
    return $this->hasMany(GCashInfo::class, 'shop_id');
}



}

