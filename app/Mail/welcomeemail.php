<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class welcomeemail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailmessage;
    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct($message,$subject)
    {
        $this->mailmessage=$message;
        $this->subject=$subject;
        
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
   public function content(): Content
{
    return new Content(
        view: 'mail.welcome-mail',
        with: [
            'mailmessage' => $this->mailmessage,
        ]
    );
}


    //    public function build()
    // {
    //     return $this->subject($this->subject)
    //                 ->view('emails.test');
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
