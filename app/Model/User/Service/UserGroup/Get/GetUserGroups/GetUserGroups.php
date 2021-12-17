<?php

namespace App\Model\User\Service\UserGroup\Get\GetUserGroups;

use App\Model\User\Repository\UserGroup\UserGroupRepository;
use App\Model\User\Service\UserGroup\Get\GetUserGroupsInterface;

class GetUserGroups implements GetUserGroupsInterface
{
    private UserGroupRepository $repository;

    public function __construct(UserGroupRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param mixed $data
     * @return mixed
     */
    public function getUserGroups($data)
    {
        return $this->repository->findBy([])
            ->loadMissing('permissions.userPermissionDescriptions');
    }
}
