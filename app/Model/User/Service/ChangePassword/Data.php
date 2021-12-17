<?php

namespace App\Model\User\Service\ChangePassword;

use App\Model\User\Entity\User;

class Data
{
    public User $user;

    public string $newPassword;

    public function __construct(User $user, string $newPassword)
    {
        $this->user = $user;
        $this->newPassword = $newPassword;
    }
}
