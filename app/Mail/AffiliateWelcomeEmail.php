<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AffiliateWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email;

    public function __construct($email)
    {
        //
        $this->email = $email;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = 'This is an example email sent from Laravel.';
        return $this->view('affiliate_welcome_email', ['message' => $message])
                    ->with(['email'=> $this->email])
                   
                    ->from('Learniix@learniix.com')
                    ->subject('Welcome!🥳🥳 To ZenithStake!🥳');
    }
}
