<?php

namespace App\Model\User\Service\RecoveryPassword\RecoveryPasswordByConfirmToken;

use App\Model\User\Repository\User\UserRepository;
use App\Model\User\Service\GeneratePassword\GeneratePasswordInterface;
use App\Model\User\Service\RecoveryPassword\RecoveryPasswordInterface;

class RecoveryPassword implements RecoveryPasswordInterface
{
    private UserRepository $userRepository;

    private GeneratePasswordInterface $generatePassword;

    public function __construct(UserRepository $userRepository,
                                GeneratePasswordInterface $generatePassword)
    {
        $this->userRepository = $userRepository;
        $this->generatePassword = $generatePassword;
    }

    /**
     * @param Data $data
     * @throws \Throwable
     */
    public function recovery($data)
    {
        $user = $this->userRepository->findOneBy(["confirm_token" => $data->confirmToken, "deleted" => false]);
        if (empty($user)) {
            throw new \DomainException("User not found by confirm token");
        }
        $generatedPassword = $this->generatePassword->generatePassword($data->password);
        $user->password = $generatedPassword->password;
        $user->salt = $generatedPassword->salt;
        $user->confirm_token = null;
        $user->saveOrFail();
    }
}
