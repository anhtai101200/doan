<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    private $data = [];
    private $cart = [];
    
    /**
     * Create a new message instance.
     * 
     * @return void
     */
        
    public function __construct($data, $cart)
    {
        $this->data = $data;
        $this->cart = $cart;
    }

    /**
     * Get the message envelope.
     * 
     * @return $this
     */

    public function build() 
    {
       
        return $this->from('nnanhtai1012@gmail.com', "Xac nhan don hang")
        ->subject($this->data['subject'])
        ->view("emails.index")->with([
            'data' => $this->data,
            'cart' => $this->cart
        ]);
    }

}
