<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $orderDetails;
    public $gcashInfo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderDetails, $gcashInfo)
    {
        $this->orderDetails = $orderDetails;
        $this->gcashInfo = $gcashInfo;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user.emails.order_approved')
        ->subject('Your order has been confirmed!')
        ->with([
            'orderDetails' => $this->orderDetails,
            'gcashInfo' => $this->gcashInfo,
        ]);
    }
}
