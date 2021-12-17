<?php

namespace App\Model\User\Service\Event;

use App\Model\User\Entity\User;

class PasswordReset
{
    public User $user;

    public string $urlRedirect;

    public function __construct(User $user, string $urlRedirect)
    {
        $this->user = $user;
        $this->urlRedirect = $urlRedirect;
    }
}
