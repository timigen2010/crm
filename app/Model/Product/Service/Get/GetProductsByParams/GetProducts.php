<?php

namespace App\Model\Product\Service\Get\GetProductsByParams;

use App\Model\Product\Repository\ProductRepository;
use App\Model\Product\Service\Get\GetProductsInterface;

class GetProducts implements GetProductsInterface
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Data $data
     * @return mixed
     */
    public function getProducts($data)
    {
        return $this->repository->findBy([
            'name' => $data->name,
            'price' => $data->price,
            'status' => $data->status,
            'saleAble' => $data->saleAble,
            'productTypeId' => $data->productTypeId,
            'deleted' => false
        ], [$data->orderBy => $data->orderDirection])
            ->loadMissing('menus', 'productType');
    }
}
