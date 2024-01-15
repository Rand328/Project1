<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $formData;
    public $id;
    public $replyMessage;

    /**
     * Create a new message instance.
     */
    public function __construct($formData, int $id,$replyMessage= null)
    {
        $this->formData = $formData;
        $this->id = $id;
        $this->replyMessage = $replyMessage; 
    } 

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Form Submitted',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->from('admin@ehb.be')
            ->markdown('emails.contact')
            ->with(['formData' => $this->formData])
            ->subject('New Contact Form Submission');
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact',
        );
    }

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
