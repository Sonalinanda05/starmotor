<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReply extends Mailable
{
    use Queueable, SerializesModels;

    public $reply;

    public function __construct($reply)
    {
        $this->reply = $reply;
    }

    public function build()
    {
        return $this->subject('Your Contact Inquiry Reply')
            ->markdown('emails.reply');
    }
}