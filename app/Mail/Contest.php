<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
                    ->with(['affiliate_email'=> $this->affiliate_email,'firstName'=>$this->firstName,'productPrice'=>$this->productPrice,'commission'=>$this->commission, "customer_name"=>$this->customer_name, "productName"=>$this->productName])
                   
                    ->from('ZenithStake@zenithstake.com')
                    ->subject('Hello Hurray 🥳🥳!!');
    }
}
