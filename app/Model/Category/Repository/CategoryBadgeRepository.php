<?php

namespace App\Model\Category\Repository;

use App\Model\Category\Entity\CategoryBadge;
use App\Model\Infrastructure\Contracts\RepositoryInterface;

class CategoryBadgeRepository implements RepositoryInterface
{
    private CategoryBadge $model;

    public function __construct(CategoryBadge $model)
    {
        $this->model = $model;
    }

    public function findOneBy(array $where)
    {
        // TODO: Implement findOneBy() method.
    }

    public function findBy(array $where = [], ?array $orderBy = [])
    {
        return $this->model->query()->get();
    }

    public function find(int $id)
    {
        return $this->model->query()->find($id);
    }

    public function getSimpleInfo()
    {
        return $this->model->query()->select(["category_badge_id as categoryBadgeId", "code"])->get()->toArray();
    }
}
