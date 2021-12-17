<?php

namespace App\Model\User\Service\EditUser\Avatar;

use App\Model\User\Entity\User;

interface EditAvatarInterface
{
    /**
     * @param mixed $data
     * @param User $user
     * @return mixed
     */
    public function setAvatar($data, User $user);
}
