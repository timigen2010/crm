<?php

namespace App\Model\Product\Service\CPFC\GetByProductId;

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

class GetCPFCByProductId implements GetCPFCByProductIdInterface
{
    private ProductCPFCRepository $repository;

    public function __construct(ProductCPFCRepository $productCPFCRepository)
    {
        $this->repository = $productCPFCRepository;
    }

    /**
     * @param int $productId
     * @return mixed
     */
    public function get(int $productId)
    {
        return $this->repository->findBy(['productId' => $productId]);
    }
}
