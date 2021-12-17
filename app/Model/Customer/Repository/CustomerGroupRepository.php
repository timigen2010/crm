<?php

namespace App\Model\Customer\Repository;

use App\Model\Customer\Entity\Group\CustomerGroup;
use App\Model\Infrastructure\Contracts\RepositoryInterface;

class CustomerGroupRepository implements RepositoryInterface
{
    public function findOneBy(array $where): ?CustomerGroup
    {
        $query = CustomerGroup::query();
        foreach ($where as $key => $value) {
            $query->where($key, '=', $value);
        }
        return $query->get()->first();
    }

    public function findBy(array $where, ?array $orderBy = [])
    {
        return CustomerGroup::query()->get();
    }

    public function find(int $id)
    {
        return CustomerGroup::query()->find($id);
    }
}
