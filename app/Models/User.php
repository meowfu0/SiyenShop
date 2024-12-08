<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Course;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';  // Set the table name to 'user'

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone_number', 'course_bloc', 'course_id', 'year', 'email', 'password',
        'role_id', 'status_id', 'profile_picture'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationship to the Course model.
     * Each user belongs to one course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id'); 
    }

    /**
     * Ensure `modified_at` is updated manually when the profile is updated.
     */
    public static function boot()
    {
        
    
        parent::boot();

        // Automatically update `modified_at` when the user is updated
        static::updating(function ($user) {
            $user->modified_at = now();
        });

        // Automatically update `last_login` when the user logs in
        static::created(function ($user) {
            // Set the initial last login to the current time when the user is created
            $user->last_login = now();
            $user->save();
        });
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function gcashInfo()
        {
        return $this->hasOne(GCashInfo::class, 'status_id');
    }

    public function permissions()
    {
        return $this->role->permissions();
    }


     public function shops()
{
    return $this->belongsToMany(Shop::class)
                ->withPivot('gcash_name', 'gcash_number', 'gcash_limit')  // Attach extra fields
                ->withTimestamps();
}

}
