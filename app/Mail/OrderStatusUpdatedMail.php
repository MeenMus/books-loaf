<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $status;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->status = $order->status;
    }

    public function build()
    {
        return $this->subject("Update on Your Order #{$this->order->id}")
                    ->markdown('emails.orders.status-update');
    }
}
