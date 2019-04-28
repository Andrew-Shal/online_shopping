<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        //
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->to($this->order->billing_email, $this->order->billing_name)->from('accounts@bzhomerentals.com', env('APP_NAME', 'online shopping'))
            ->bcc('accounts@bzhomerentals.com')
            ->subject('Order from Online Shopping')
            ->markdown('emails.orders.placed');
    }
}
