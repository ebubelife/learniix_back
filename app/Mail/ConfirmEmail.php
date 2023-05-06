<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $emailCode;
    public $firstName;
 
    public function __construct($emailCode,$firstName)
    {
        //
        $this->firstName = $firstName;
        $this->emailCode = $emailCode;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      

        $message = 'This is an example email sent from Laravel.';
        return $this->view('recover_email', ['message' => $message])
                    ->with(['emailCode'=> $this->emailCode, 'firstName'=>$this->firstName])
                   
                    ->from('sender@example.com')
                    ->subject('Account recovery');
    }
}
