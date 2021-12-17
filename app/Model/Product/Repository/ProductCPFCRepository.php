<?php

namespace App\Model\Product\Repository;

use App\Model\Product\Entity\Product;
use App\Model\Product\Entity\ProductCPFC;
use Illuminate\Database\Query\JoinClause;

class ProductCPFCRepository
{
    private ProductCPFC $model;

    public function __construct(ProductCPFC $model)
    {
        $this->model = $model;
    }

    public function findBy(array $where, ?array $orderBy = [])
    {
        $query = $this->model->query();
        if (!empty($where['productId'])) {
            $query->where('product_id', '=', $where['productId']);
        }
        if (!empty($where['productIds'])) {
            $query->whereIn('product_id', $where['productIds']);
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
        return ProductCPFC::query()->find($id);
    }
}
