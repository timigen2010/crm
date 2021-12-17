<?php

namespace App\Model\User\Service\EventListeners;

use App\Mail\PasswordResetMail;
use App\Model\User\Service\Event\PasswordReset;
use Illuminate\Contracts\Mail\Mailer as MailerContract;

class PasswordResetListener
{
    private MailerContract $mailer;

    public function __construct(MailerContract $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(PasswordReset $event)
    {
        $this->mailer->to($event->user->userProfile->email)->send(
            new PasswordResetMail($event->user->confirm_token, $event->urlRedirect)
        );
    }
}
