<?php

namespace App\Model\User\Repository\UserGroup;

use App\Model\Infrastructure\Contracts\RepositoryInterface;
use App\Model\User\Entity\UserGroup;

class UserGroupRepository implements RepositoryInterface
{
    public function findOneBy(array $where): ?UserGroup
    {
        $query = UserGroup::query();
        foreach ($where as $key => $value) {
            $query->where($key, '=', $value);
        }
        return $query->get()->first();
    }

    public function findBy(array $where, ?array $orderBy = [])
    {
        return UserGroup::query()->orderBy('name')->get();
    }

    public function find(int $id)
    {
        return UserGroup::query()->find($id);
    }
}
