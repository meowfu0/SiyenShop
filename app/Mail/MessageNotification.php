<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $senderName;

    /**
     * Create a new message instance.
     *
     * @param string $message
     * @param string $senderName
     */
    public function __construct($message, $senderName)
    {
        $this->message = $message;
        $this->senderName = $senderName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('components.emailers.message_notification') // Ensure this path is correct
                    ->subject('New Message Notification')
                    ->with([
                        'senderName' => $this->senderName,
                        'message' => $this->message,
                    ]);
    }

    
}
