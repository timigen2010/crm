<?php

namespace App\Model\User\Service\Permission\Get\GetPermissions;

use App\Model\User\Entity\Permission\UserPermission;
use App\Model\User\Repository\Permission\UserPermissionRepository;
use App\Model\User\Service\Permission\Get\GetPermissionsInterface;
use Illuminate\Support\Collection;

class GetPermissions implements GetPermissionsInterface
{
    private UserPermissionRepository $repository;

    public function __construct(UserPermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Data $data
     * @return Collection<UserPermission>
     */
    public function getPermissions($data = null)
    {
        return $this->repository->findBy([]);
    }
}
