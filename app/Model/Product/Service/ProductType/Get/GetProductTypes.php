<?php

namespace App\Model\Product\Service\ProductType\Get;

use App\Model\Product\Repository\ProductTypeRepository;

class GetProductTypes implements GetProductTypesInterface
{
    private ProductTypeRepository $repository;

    public function __construct(ProductTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get()
    {
        return $this->repository->getAll();
    }
}
