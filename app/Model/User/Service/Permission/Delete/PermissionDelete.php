<?php

namespace App\Model\User\Serivce\Permission\Delete;

use App\Model\User\Entity\Permission\UserPermission;

class PermissionDelete implements PermissionDeleteInterface
{

    /**
     * @param UserPermission $permission
     * @throws \Exception
     */
    public function delete(UserPermission $permission)
    {
        $permission->userPermissionDescriptions()->delete();
        $permission->delete();
    }
}
