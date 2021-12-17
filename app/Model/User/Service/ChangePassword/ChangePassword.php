<?php

namespace App\Model\User\Service\ChangePassword;

use App\Model\User\Service\GeneratePassword\GeneratePasswordInterface;

class ChangePassword implements ChangePasswordInterface
{
    private GeneratePasswordInterface $generatePassword;

    public function __construct(GeneratePasswordInterface $generatePassword)
    {
        $this->generatePassword = $generatePassword;
    }

    /**
     * @param Data $data
     * @throws \Throwable
     */
    public function changePassword($data)
    {
        $responseGeneratedPassword = $this->generatePassword->generatePassword($data->newPassword);
        $data->user->password = $responseGeneratedPassword->password;
        $data->user->salt = $responseGeneratedPassword->salt;
        $data->user->saveOrFail();
    }
}
