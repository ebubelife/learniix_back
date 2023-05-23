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
   
    public function __construct($vendor_email )
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
        return $this->view('vendor_sale_email', ['message' => $message])
                    ->with(['vendor_email'=> $this->vendor_email])
                   
                    ->from('accounts@zenithstake.com')
                    ->subject('ZenithStake - Congratulations on your new sale!');
    }
}
