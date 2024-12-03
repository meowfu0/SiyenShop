<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

public function users()
{
    return $this->belongsToMany(User::class, 'user_roles_permissions', 'permission_id', 'user_id')
                ->withPivot('role_id');
}

// Relationship with roles
public function roles()
{
    return $this->belongsToMany(Role::class, 'user_roles_permissions', 'permission_id', 'role_id')
                ->withPivot('user_id');
}
}


