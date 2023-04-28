<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoverAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $emailCode;
    public function __construct($emailCode)
    {
        //
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
        return $this->view('test_email', ['message' => $message])
                    ->with('myVariable', $this->emailCode)
                    ->from('sender@example.com')
                    ->subject('Account recovery');
    }
}
