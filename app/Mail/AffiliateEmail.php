<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AffiliateEmail extends Mailable
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
    public $customer_email;
   
    public function __construct($affiliate_email,$firstName,$productPrice,$commission, $customer_email )
    {
        //

        $this->firstName = $firstName;
        $this->affiliate_email = $affiliate_email;
        $this->productPrice = $productPrice;
        $this->commission = $commission;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = 'This is an example email sent from Laravel.';
        return $this->view('affiliate_sale_email', ['message' => $message])
                    ->with(['affiliate_email'=> $this->affiliate_email,'firstName'=>$this->firstName,'productPrice'=>$this->productPrice,'commission'=>$this->commission])
                   
                    ->from('accounts@zenithstake.com')
                    ->subject('ZenithStake - Congratulations🥳🥳 on your new sale!🥳');
    }
}
