<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AffiliatePayment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $affiliate_name;
     public $amount;
    public function __construct( $amount, $affiliate_name)
    {
        //
        $this->affiliate_name = $affiliate_name;
        $this->amount= $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = 'This is an example email sent from Laravel.';
        return $this->view('affiliate_payment_email', ['message' => $message])
                    ->with(['name'=> $this->affiliate_name, 'amount'=> $this->amount])
                   
                    ->from('zenithstake@gmail.com')
                    ->subject('Payment Received🥳');
    }
}
