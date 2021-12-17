<?php

namespace App\Model\User\Service\GeneratePassword;

class GeneratePasswordSha1 implements GeneratePasswordInterface
{

    public function generatePassword(string $password): Response
    {
        $salt = substr(sha1(uniqid(rand(), true)), 0, 9);
        $password = md5($salt . md5($salt . md5($password)));
        return new Response($password, $salt);
    }
}
