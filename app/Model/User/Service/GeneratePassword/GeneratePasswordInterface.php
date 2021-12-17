<?php

namespace App\Model\User\Service\GeneratePassword;

interface GeneratePasswordInterface
{
    public function generatePassword(string $password): Response;
}
