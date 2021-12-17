<?php

namespace App\Model\User\Repository\Permission;

use App\Model\Infrastructure\Contracts\RepositoryInterface;
use App\Model\User\Entity\Permission\UserPermission;

class UserPermissionRepository implements RepositoryInterface
{
    public function findOneBy(array $where): ?UserPermission
    {
        $query = UserPermission::query();
        foreach ($where as $key => $value) {
            if ($key === 'user_group_id') {
                $query->join(
                    'user_groups_to_permissions',
                    'user_groups_to_permissions.user_permission_id',
                    '=',
                    'user_permissions.user_permission_id'
                )->where('user_group_id', '=', $value);
            } else {
                $query->where($key, '=', $value);
            }
        }
        return $query->get()->first();
    }

    public function findBy(array $where, ?array $orderBy = [])
    {
        $queryByIndex = UserPermission::query()->select('user_permission_id')->limit(100);

        $query = UserPermission::query();
        $query->joinSub($queryByIndex, 'limit', function ($join) {
            $join->on('user_permissions.user_permission_id', '=', 'limit.user_permission_id');
        });
        $query->with('userPermissionDescriptions')->join('user_permission_descriptions','user_permission_descriptions.user_permission_id', '=', 'user_permissions.user_permission_id');

        return $query->get();
    }

    public function find(int $id)
    {
        return UserPermission::query()->find($id);
    }
}
