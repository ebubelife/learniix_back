<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $vendor_email;
    public $firstName;
    public $productPrice;
    public $commission;
   
    public function __construct($vendor_email,  $firstName, $productPrice, $commission )
    {
        //
        $this->firstName = $firstName;
        $this->vendor_email =$vendor_email;
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
        return $this->view('vendor_sale_email', ['message' => $message])
                    ->with(['vendor_email'=> $this->vendor_email,'firstName'=>$this->firstName,'productPrice'=>$this->productPrice,'commission'=>$this->commission])
                   
                    ->from('accounts@zenithstake.com')
                    ->subject('Congratulations🥳🥳 on your new sale!🥳');
    }
}
