<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $memberName;
    public $email;
    public $transactionType;
    public $amount;
    public $referenceNumber;
    public $transactionDate;
    public $newBalance;
    public $balanceType;

    public function __construct($email, $memberName, $transactionType, $amount, $referenceNumber, $transactionDate, $newBalance = null, $balanceType = null)
    {
        $this->email = $email;
        $this->memberName = $memberName;
        $this->transactionType = $transactionType;
        $this->amount = $amount;
        $this->referenceNumber = $referenceNumber;
        $this->transactionDate = $transactionDate;
        $this->newBalance = $newBalance;
        $this->balanceType = $balanceType;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = 'Payment Received - ' . config('app.name', 'GBLDC Cooperative');
        
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Emails.payment_notification',
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
