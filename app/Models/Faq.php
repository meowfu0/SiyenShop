<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'questions',
        'answers',
        'status_id',
    ];

    // Specify that the model should use 'modified_at' instead of 'updated_at'
    const UPDATED_AT = 'modified_at';
    protected $dates = ['deleted_at']; 

    public $timestamps = false; 
}