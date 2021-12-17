<?php

namespace App\Model\User\Serivce\UserGroup\Delete;

use App\Model\User\Entity\UserGroup;

class UserGroupDelete implements UserGroupDeleteInterface
{

    /**
     * @param UserGroup $userGroup
     * @throws \Exception
     */
    public function delete(UserGroup $userGroup)
    {
        $userGroup->permissions()->detach();
        $userGroup->delete();
    }
}
