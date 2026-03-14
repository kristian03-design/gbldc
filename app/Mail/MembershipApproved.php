<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MembershipApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $memberName;
    public $memberNumber;
    public $username;
    public $password;

    public function __construct($email, $memberName, $memberNumber, $username, $password)
    {
        $this->email = $email;
        $this->memberName = $memberName;
        $this->memberNumber = $memberNumber;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to GBLDC Cooperative - Membership Approved!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Emails.membership_approved',
            with: [
                'email' => $this->email,
                'memberName' => $this->memberName,
                'memberNumber' => $this->memberNumber,
                'username' => $this->username,
                'password' => $this->password,
            ],
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
