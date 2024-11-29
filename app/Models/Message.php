<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id',
        'recipient_id',
        'message',
    ];

    // Specify the table if it's not the pluralized model name
    protected $table = 'messages';

    // Disable default timestamps and specify custom ones
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at'; // Use 'modified_at' instead of 'updated_at'

    /**
     * Get the sender of the message.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the recipient of the message.
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
