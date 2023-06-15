<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class PrincipalMail extends Mailable
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
    * Get the message envelope.
    *
    * @return \Illuminate\Mail\Mailables\Envelope
    */
    
    /**
    * Get the message envelope.
    *
    * @return \Illuminate\Mail\Mailables\Envelope
    */
    public function envelope()
    {
        return new Envelope(
            from: new Address('noreply.sicc@gmail.com', 'Test Sender'),
            subject: 'Test Email',
        );
    }
    
    /**
    * Get the message content definition.
    *
    * @return \Illuminate\Mail\Mailables\Content
    */
    public function content()
    {
        return new Content(
            view: 'teste',
        );
    }
    
    /**
    * Get the attachments for the message.
    *
    * @return array
    */
    public function attachments()
    {
        return [];
    }
}
