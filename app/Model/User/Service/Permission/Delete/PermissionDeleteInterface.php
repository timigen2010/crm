<?php

namespace App\Model\User\Serivce\Permission\Delete;

use App\Model\User\Entity\Permission\UserPermission;

interface PermissionDeleteInterface
{
    public function delete(UserPermission $permission);
}
