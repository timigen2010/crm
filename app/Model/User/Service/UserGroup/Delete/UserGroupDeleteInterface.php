<?php

namespace App\Model\User\Serivce\UserGroup\Delete;

use App\Model\User\Entity\UserGroup;

interface UserGroupDeleteInterface
{
    public function delete(UserGroup $userGroup);
}
