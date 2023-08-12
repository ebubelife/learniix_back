<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class AffiliatePayment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $affiliate_name;
     public $amount;
    public function __construct( $amount, $affiliate_name)
    {
        //
        $this->affiliate_name = $affiliate_name;
        $this->amount= intval($amount);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $naira_exchange_rate = DB::selectOne('SELECT value FROM settings WHERE settings_key = ? LIMIT 1', ['usd_to_naira']);

        $ghs_exchange_rate = DB::selectOne('SELECT value FROM settings WHERE settings_key = ? LIMIT 1', ['usd_to_ghs']);
    
        $message = 'This is an example email sent from Laravel.';
        return $this->view('affiliate_payment_email', ['message' => $message])
                    ->with(['affiliate_name'=> $this->affiliate_name, 'amount'=> strval($this->amount/intval($naira_exchange_rate))])
                   
                    ->from('Zenithstake@zenithstake.com')
                    ->subject('Holy Sunday, Alert!🥳');
    }
}
