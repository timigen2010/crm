<?php

namespace App\Model\User\Serivce\DeleteUser;

use App\Model\User\Entity\User;

interface UserDeleteInterface
{
    public function delete(User $user);
}
