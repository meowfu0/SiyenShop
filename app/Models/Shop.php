<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Status;
use App\Models\User;

class Shop extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'shop_name', 'shop_description', 'shop_logo', 'user_id', 'course_id', 'status_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id'); 
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
