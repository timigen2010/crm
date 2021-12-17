<?php

namespace App\Model\Product\Service\CPFC\GetByProductIds;

use App\Model\Product\Entity\Product;
use App\Model\Product\Entity\ProductCPFC;
use App\Model\Product\Entity\ProductImage;
use App\Model\Product\Repository\ProductCPFCRepository;
use App\Model\Product\Repository\ProductRepository;
use App\Model\Product\Service\CPFC\Calculate\CalculateInterface;
use App\Model\Product\Service\CPFC\Factory\CPFCFactoryAbstract;
use App\Model\Product\Service\CPFC\Factory\Data;
use App\Model\Report\ProductComplect\Repository\ProductComplectRepository;
use App\Service\File\Delete\FileDeleteInterface;
use Exception;

class GetCPFCByProductIds implements GetCPFCByProductIdsInterface
{
    private ProductCPFCRepository $repository;

    public function __construct(ProductCPFCRepository $productCPFCRepository)
    {
        $this->repository = $productCPFCRepository;
    }

    /**
     * @param array $productIds
     * @return mixed
     */
    public function get(array $prductIds)
    {
        return $this->repository->findBy(['productIds' => $prductIds]);
    }
}
