<?php

namespace App\Model\User\Service\Permission\Get;

use App\Model\User\Entity\Permission\UserPermission;

interface GetPermissionInterface
{
    public function getPermission($data): ?UserPermission;
}
