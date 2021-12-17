<?php

namespace App\Model\User\Service\Permission\Factory;

use App\Model\User\Entity\Permission\UserPermission;

class PermissionFactory extends PermissionFactoryAbstract
{

    /**
     * @param Data $data
     * @param UserPermission $permission
     * @return UserPermission
     * @throws \Throwable
     */
    protected function setData(Data $data, UserPermission $permission): UserPermission
    {
        $permission->name = $data->name;
        $permission->userPermissionDescriptions()->delete();
        $permission->saveOrFail();
        foreach ($data->descriptions as $description) {
            $permission->userPermissionDescriptions()->create([
                'user_permission_id' => $permission->user_permission_id,
                'description' => $description['description'],
                'language_id' => $description['languageId'],
            ]);
        }
        return $permission;
    }
}
