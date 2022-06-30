<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $payment)
    {
        $this->data['order'] = $order->toArray();
        $this->data['payment'] = $payment->toArray();
        // $this->data = array_merge($order->toArray(),$payment->toArray());
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bayaran untuk Pesanan #'.$this->data['order']['id'].' - '. config('app.name'))->markdown('emails.payment', $this->data);
    }
}
