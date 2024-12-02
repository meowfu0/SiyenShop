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

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone_number', 'course_bloc', 'course_id', 'year', 'email', 'password',
        'role_id', 'status_id'
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
     * Relationship to the Role model.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function status()
{
    return $this->belongsTo(Status::class, 'status_id');
}
     // Relationship with roles
     public function rolesForPermissions()
     {
         return $this->belongsToMany(Role::class, 'user_roles_permissions', 'user_id', 'role_id')
                     ->withPivot('permission_id');
     }
 
     // Relationship with permissions
     public function permissions()
     {
         return $this->belongsToMany(Permission::class, 'user_roles_permissions', 'user_id', 'permission_id')
                     ->withPivot('role_id');
     }

}


