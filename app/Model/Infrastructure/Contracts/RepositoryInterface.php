<?php

namespace App\Model\Infrastructure\Contracts;

interface RepositoryInterface
{
    public function findOneBy(array $where);

    public function findBy(array $where, ?array $orderBy = []);

    public function find(int $id);
}
