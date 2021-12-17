<?php

namespace App\Model\User\Service\UserGroup\Factory;

use App\Model\User\Entity\UserGroup;
use App\Model\User\Repository\Permission\UserPermissionRepository;

class UserGroupFactory extends UserGroupFactoryAbstract
{
    private UserPermissionRepository $userPermissionRepository;

    public function __construct(UserPermissionRepository $userPermissionRepository)
    {
        $this->userPermissionRepository = $userPermissionRepository;
    }

    /**
     * @param Data $data
     * @param UserGroup $userGroup
     * @return UserGroup
     * @throws \Throwable
     */
    protected function setData(Data $data, UserGroup $userGroup): UserGroup
    {
        $userGroup->name = $data->name;
        $userGroup->permissions()->detach();
        $userGroup->saveOrFail();
        foreach ($data->permissions as $permissionId) {
            if ($permission = $this->userPermissionRepository->find($permissionId)) {
                $userGroup->permissions()->attach($permission);
            }
        }
        return $userGroup;
    }
}
