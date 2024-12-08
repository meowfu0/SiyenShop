<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['status_name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }
}
