<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class MemberResetPasswordNotification extends ResetPassword
{
    public function toMail($notifiable)
    {
        $url = url(route('Member.ResetPassword', [
            'token' => $this->token,
            'email' => method_exists($notifiable, 'getEmailForPasswordReset')
                ? $notifiable->getEmailForPasswordReset()
                : null,
        ], false));

        return (new MailMessage)
            ->subject('Reset Your Member Portal Password')
            ->view('emails.member_reset_password', ['url' => $url]);
    }
}

