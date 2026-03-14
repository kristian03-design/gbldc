<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoanStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $memberName;
    public $email;
    public $loanNumber;
    public $loanAmount;
    public $status;
    public $statusMessage;
    public $dueAmount;
    public $paymentStartDate;
    public $frequencyOfPayment;

    public function __construct($email, $memberName, $loanNumber, $loanAmount, $status, $statusMessage, $dueAmount = null, $paymentStartDate = null, $frequencyOfPayment = null)
    {
        $this->email = $email;
        $this->memberName = $memberName;
        $this->loanNumber = $loanNumber;
        $this->loanAmount = $loanAmount;
        $this->status = $status;
        $this->statusMessage = $statusMessage;
        $this->dueAmount = $dueAmount;
        $this->paymentStartDate = $paymentStartDate;
        $this->frequencyOfPayment = $frequencyOfPayment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = 'Loan Application ' . ucfirst($this->status) . ' - ' . config('app.name', 'GBLDC Cooperative');
        
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
            view: 'Emails.loan_status_notification',
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
