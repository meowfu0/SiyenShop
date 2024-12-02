<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['role_name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }


public function usersForPermission()
    {
        return $this->belongsToMany(User::class, 'user_roles_permissions', 'role_id', 'user_id')
                    ->withPivot('permission_id');
    }

    // Relationship with permissions
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_roles_permissions', 'role_id', 'permission_id')
                    ->withPivot('user_id');
    }
}