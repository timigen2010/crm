<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $confirmToken;

    public string $redirectUrl;

    /**
     * Create a new message instance.
     * @param string $confirmToken
     * @param string $redirectUrl
     * @return void
     */
    public function __construct(string $confirmToken, string $redirectUrl)
    {
        $this->confirmToken = $confirmToken;
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Reset password')
            ->markdown('emails.user.reset_password');
    }
}
