<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FinishReg extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $tx_id;
    public $firstName;

    public function __construct($firstName, $tx_id)
    {
        //

        $this->firstName = $firstName;
        $this->tx_id = $tx_id;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = 'This is an example email sent from Laravel.';
        return $this->view('finish_signup', ['message' => $message])
                    ->with(['tx_id'=> $this->tx_id, 'firstName'=>$this->firstName])
                   
                    ->from('Zenithstake@zenithstake.com')
                    ->subject('Complete your registration as an affiliate');
    }
}
