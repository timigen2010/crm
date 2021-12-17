<?php

namespace App\Model\User\Serivce\DeleteUser;

use App\Model\User\Entity\User;

class UserDelete implements UserDeleteInterface
{

    /**
     * @param User $user
     */
    public function delete(User $user)
    {
        $user->deleted = true;
        $user->save();
    }
}
