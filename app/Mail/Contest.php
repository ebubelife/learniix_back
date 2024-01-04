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

     public $firstName;
    public function __construct($firstName)
    {
        //
        $this->firstName = $firstName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        $message = 'This is an example email sent from Laravel.';
        return $this->view('contest', ['message' => $message])
                    ->with(['firstName'=> $this->firstName])
                   
                    ->from('Learniix@learniix.com')
                    ->subject('New Challenge 🥳🥳!!');
    }
}
