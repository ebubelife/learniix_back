<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseAccess extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $productTYLink;
    public $customerName;
    public $productName;

    public function __construct($customerName, $productTYLink,$productName)
    {
        //

        $this->customerName = $customerName;
        $this->productTYLink = $productTYLink;
        $this->$productName  = $productName;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = 'This is an example email sent from Laravel.';
        return $this->view('access_course', ['message' => $message])
                    ->with(['productTYLink'=> $this->productTYLink, 'customerName'=>$this->customerName, 'productName'=>$this->productName])
                   
                    ->from('Zenithstake@zenithstake.com')
                    ->subject('Access your course');
    }
}
