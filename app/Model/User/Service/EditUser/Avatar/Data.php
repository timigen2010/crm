<?php

namespace App\Model\User\Service\EditUser\Avatar;

class Data
{
    public string $avatar;

    public function __construct(string $avatar)
    {
        $this->avatar = $avatar;
    }
}
