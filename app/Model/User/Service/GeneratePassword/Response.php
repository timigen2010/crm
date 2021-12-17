<?php

namespace App\Model\User\Service\GeneratePassword;

class Response
{
    public string $password;

    public ?string $salt;

    public function __construct(string $password, ?string $salt = null)
    {
        $this->password = $password;
        $this->salt = $salt;
    }
}
