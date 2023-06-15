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
        return $this->view('contest', ['message' => $message])
                    ->with(['key'=> '1'])
                   
                    ->from('ZenithStake@zenithstake.com')
                    ->subject('Hello Hurray 🥳🥳!!');
    }
}
