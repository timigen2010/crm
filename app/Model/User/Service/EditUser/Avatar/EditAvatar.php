<?php

namespace App\Model\User\Service\EditUser\Avatar;

use App\Model\User\Entity\User;

class EditAvatar implements EditAvatarInterface
{

    /**
     * @param Data $data
     * @param User $user
     * @return User
     */
    public function setAvatar($data, User $user): User
    {
        $user->userProfile()->update([
            'avatar' => $data->avatar
        ]);
        return $user;
    }
}
