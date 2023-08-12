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
    public $customer_name;
    public $productName;
   
    public function __construct($affiliate_email,$firstName,$productPrice,$commission, $customer_name, $productName )
    {
        //

        $this->firstName = $firstName;
        $this->affiliate_email = $affiliate_email;
        $this->productPrice = $productPrice;
        $this->commission = $commission;
        $this->customer_name = $customer_name;
        $this->productName = $productName;
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
                    ->subject('Congratulations🥳🥳 on your new sale!🥳');
    }
}
