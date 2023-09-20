<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $affiliate_email;
    public $firstName;
    public $productPrice;
    public $commission;
    public $customer_name;
    public $productName;
   
    public function __construct($affiliate_email )
    {
        //

      
        $this->affiliate_email = $affiliate_email;
      
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


   

        $message = 'Test email';
        return $this->view('affiliate_email_message', ['message' => $message])
                    ->with(['affiliate_email'=> $this->affiliate_email])
                   
                    ->from('ZenithStake@zenithstake.com')
                    ->subject('Notice on Payment Reversal');
    }
}
