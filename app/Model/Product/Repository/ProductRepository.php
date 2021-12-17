<?php

namespace App\Model\Product\Repository;

use App\Model\Product\Entity\Product;
use Illuminate\Database\Query\JoinClause;

class ProductRepository
{
    private Product $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function findBy(array $where, ?array $orderBy = [])
    {
        $query = $this->model->query();
        if ($where['name']) {
            $query->where('name', '=', $where['name']);
        }
        if ($where['price']) {
            $query->where('price', '=', $where['price']);
        }
        if (!is_null($where['status'])) {
            $query->where('status','=',  $where['status']);
        }
        if (!is_null($where['saleAble'])) {
            $query->where('sale_able', '=', $where['saleAble']);
        }
        if ($where['productTypeId']) {
            $query->where('product_type_id', '=', $where['productTypeId']);
        }
        if (!is_null($where['deleted'])) {
            $query->where('deleted', '=', $where['deleted']);
        }
        if ($orderBy) {
            foreach ($orderBy as $key => $item) {
                $query->orderBy($key, $item);
            }
        }
        $query->limit(50);
        return $query->get();
    }

    public function find(int $id)
    {
        return Product::query()->find($id);
    }

    public function findByMenuId(int $menuId)
    {
        return $this->model->query()
            ->with('categories')
            ->with('menus')
            ->with('weightClass.descriptions')
            ->with('productType')
            ->join("products_to_menus", function(JoinClause $clause) {
                $clause->on(
                    'products.product_id',
                    '=',
                    'products_to_menus.product_id');
            })->where("products_to_menus.menu_id", "=", $menuId)
            ->join("products_to_categories", function(JoinClause $clause) {
                $clause->on(
                    'products.product_id',
                    '=',
                    'products_to_categories.product_id');
            })->join("categories", function(JoinClause $clause) {
                $clause->on(
                    'categories.category_id',
                    '=',
                    'products_to_categories.category_id');
            })
            ->where("products_to_menus.menu_id", "=", $menuId)
            ->where("products.status", "=", 1)
            ->where("products.deleted", "=", 0)
            ->where("products.sale_able", "=", 1)
            ->where("categories.status", "=", 1)
            ->groupBy("products.product_id")
            ->get();
    }

    public function findByCategories(array $categoriesIds)
    {
        return $this->model->query()
            ->join("products_to_categories", function(JoinClause $clause) {
                $clause->on(
                    'products.product_id',
                    '=',
                    'products_to_categories.product_id');
            })->whereIn("products_to_categories.category_id", $categoriesIds)
            ->where("products.status", "=", 1)
            ->where("products.deleted", "=", 0)
            ->get();
    }
}
