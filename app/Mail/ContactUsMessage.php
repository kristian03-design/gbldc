<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactUsMessage extends Mailable
{
    use Queueable, SerializesModels;

    public string $memberName;
    public string $memberEmail;
    public string $subjectLine;
    public string $body;

    public function __construct(string $memberName, string $memberEmail, string $subjectLine, string $body)
    {
        $this->memberName = $memberName;
        $this->memberEmail = $memberEmail;
        $this->subjectLine = $subjectLine;
        $this->body = $body;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Member Contact: ' . $this->subjectLine,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'Emails.contact_us',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

