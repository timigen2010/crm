<?php

namespace App\Model\Category\Repository;

use App\Model\Category\Entity\Category;
use App\Model\Language\Entity\Language;
use Illuminate\Database\Query\JoinClause;

class CategoryRepository
{
    private Category $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function findBy(array $where, ?array $orderBy = [])
    {
        $query = $this->model->query();
        if (isset($where['status'])) {
            $query->where('status', '=', $where['status']);
        }
        if (!empty($where['name']) && !empty($where['languageId'])) {
            $query
                ->join(
                    "category_descriptions",
                    "category_descriptions.category_id",
                    "=",
                    "categories.category_id"
                )
                ->where("category_descriptions.language_id", "=", $where["languageId"])
                ->where("category_descriptions.name", "like", "{$where['name']}%");
        }
        if ($orderBy) {
            foreach ($orderBy as $key => $item) {
                $query->orderBy($key, $item);
            }
        }
        return $query->get();
    }

    public function find(int $id): ?Category
    {
        return $this->model->query()->find($id);
    }

    public function findByMenuId(int $menuId)
    {
        return $this->model->query()
            ->with('menus')
            ->with('descriptions')
            ->join("categories_to_menus", function(JoinClause $clause) {
                $clause->on(
                    'categories.category_id',
                    '=',
                    'categories_to_menus.category_id');
            })->where("categories_to_menus.menu_id", "=", $menuId)
            ->where("categories.status", "=", 1)
            ->get();
    }

    public function getSimpleInfo(?int $languageId = null)
    {
        $languageId ??= Language::RU_ID;
        return $this->model->query()
            ->leftJoin('category_descriptions', function (JoinClause $join) {
                $join->on('categories.category_id', '=', 'category_descriptions.category_id');
            })
            ->where("category_descriptions.language_id", "=", $languageId)
            ->select(["categories.category_id as categoryId", "category_descriptions.name"])->get()->toArray();
    }
}
