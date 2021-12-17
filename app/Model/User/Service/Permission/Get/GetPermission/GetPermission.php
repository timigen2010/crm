<?php

namespace App\Model\User\Service\Permission\Get\GetPermission;

use App\Model\User\Entity\Permission\UserPermission;
use App\Model\User\Repository\Permission\UserPermissionRepository;
use App\Model\User\Service\Permission\Get\GetPermissionInterface;

class GetPermission implements GetPermissionInterface
{
    private UserPermissionRepository $repository;

    public function __construct(UserPermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Data $data
     * @return UserPermission | null
     */
    public function getPermission($data): ?UserPermission
    {
        return $this->repository->findOneBy([
            'name' => $data->name,
            'user_group_id' => $data->userGroupId
        ]);
    }
}
