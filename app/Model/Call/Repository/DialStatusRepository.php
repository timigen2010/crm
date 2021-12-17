<?php

namespace App\Model\Call\Repository;

use App\Model\Call\Entity\DialStatus;
use App\Model\Infrastructure\Contracts\RepositoryInterface;

class DialStatusRepository implements RepositoryInterface
{
    public function findOneBy(array $where, ?array $orderBy = [])
    {
        $query = DialStatus::query();
        foreach ($where as $key => $value) {
            $query->where($key, '=', $value);
        }
        if ($orderBy) {
            foreach ($orderBy as $key => $item) {
                $query->orderBy($key, $item);
            }
        }
        return $query->get()->first();
    }

    public function findBy(array $where, ?array $orderBy = [])
    {
        $query = DialStatus::query();
        foreach ($where as $key => $value) {
            $query->where($key, '=', $value);
        }
        if ($orderBy) {
            foreach ($orderBy as $key => $item) {
                $query->orderBy($key, $item);
            }
        }
        if ($orderBy) {
            foreach ($orderBy as $key => $item) {
                $query->orderBy($key, $item);
            }
        }
        return $query->get();
    }

    public function find(int $id)
    {
        return DialStatus::query()->find($id);
    }
}
