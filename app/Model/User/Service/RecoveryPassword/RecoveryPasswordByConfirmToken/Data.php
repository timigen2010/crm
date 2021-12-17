<?php

namespace App\Model\User\Service\RecoveryPassword\RecoveryPasswordByConfirmToken;

class Data
{
    public string $confirmToken;

    public string $password;

    public function __construct(string $confirmToken, string $password)
    {
        $this->confirmToken = $confirmToken;
        $this->password = $password;
    }
}
