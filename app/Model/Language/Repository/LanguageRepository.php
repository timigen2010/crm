<?php

namespace App\Model\Language\Repository;

use App\Model\Language\Entity\Language;
use App\Model\Infrastructure\Contracts\RepositoryInterface;

class LanguageRepository implements RepositoryInterface
{
    private Language $model;

    public function __construct(Language $model)
    {
        $this->model = $model;
    }

    public function findOneBy(array $where)
    {
        $query = $this->model->query();
        foreach ($where as $key => $item) {
            $query->where($key, $item);
        }
        return $query->first();
    }

    public function findBy(array $where, ?array $orderBy = [])
    {
        $query = $this->model->query();
        if (isset($where['deleted'])) {
            $query->where('deleted', $where['deleted']);
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
        // TODO: Implement find() method.
    }

    public function getSimpleInfo()
    {
        return $this->model->query()->select(["language_id as languageId", "code"])->get()->toArray();
    }
}
