<?php

// In OrderStatusUpdate Mailable
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $order;
    public $orderItems;
    public $categories;
    public $shop;
    public $variant_item;

    public function __construct($user, $order, $orderItems, $categories, $shop, $variant_item)
    {
        $this->user = $user;
        $this->order = $order;
        $this->orderItems = $orderItems;
        $this->categories = $categories;
        $this->shop = $shop;
        $this->variant_item = $variant_item;
    }

    public function build()
    {   
        return $this->subject('Order Status Update')->view('emails.order_status_update');
    }
}
