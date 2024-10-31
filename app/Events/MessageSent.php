<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;

    // Constructor to initialize the properties
    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    // Define the broadcasting channel
    public function broadcastOn()
    {
        return new Channel('chat-channel');
    }

    // Define what data will be sent with the broadcast
    public function broadcastWith()
    {
        return [
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'message' => $this->message->message,
            'sender_id' => $this->message->sender_id,
            'recipient_id' => $this->message->recipient_id,
            'created_at' => $this->message->created_at,
        ];
    }

    public function broadcastAs()
    {
        return 'chat-event';
    }
}
