<?php

namespace App\Model\Product\Repository;

use App\Model\Product\Entity\ProductType;

class ProductTypeRepository
{
    private ProductType $model;

    public function __construct(ProductType $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->query()->get();
    }

    public function getByTypeCode(string $typeCode)
    {
        return $this->model->query()
            ->where('type_code', '=', $typeCode)
            ->first();
    }

    public function getSimpleInfo()
    {
        return $this->model->query()->select(["product_type_id as productTypeId", "type_code as typeCode"])->get()->toArray();
    }
}
