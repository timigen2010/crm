<?php

namespace App\Model\Report\ProductComplect\Service\Get\GetProductComplectsByParams;

use App\Model\Report\ProductComplect\Repository\ProductComplectRepository;
use App\Model\Product\Service\Get\GetProductsInterface;
use App\Model\Report\ProductComplect\Service\Get\GetProductComplectsInterface;

class GetProductComplects implements GetProductComplectsInterface
{
    private ProductComplectRepository $repository;

    public function __construct(ProductComplectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @param string|null $name
     * @return mixed
     */
    public function getProductComplects(?Data $data)
    {
        return $this->repository->lastComplects((array)$data)
            ->loadMissing(['complects.material.cpfc', 'cpfc', 'complects.unitClass.descriptions']);
    }
}
