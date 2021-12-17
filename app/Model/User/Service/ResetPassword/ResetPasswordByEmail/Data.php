<?php

namespace App\Model\User\Service\ResetPassword\ResetPasswordByEmail;

class Data
{
    public string $email;

    public string $urlRedirect;

    public function __construct(string $email, string $urlRedirect)
    {
        $this->email = $email;
        $this->urlRedirect = $urlRedirect;
    }
}
