<?php

namespace App\Model\Product\Service\CPFC\Edit;

use App\Model\Product\Entity\Product;
use App\Model\Product\Entity\ProductCPFC;
use App\Model\Product\Entity\ProductImage;
use App\Model\Product\Repository\ProductRepository;
use App\Model\Product\Service\CPFC\Calculate\CalculateInterface;
use App\Model\Product\Service\CPFC\Factory\CPFCFactoryAbstract;
use App\Model\Product\Service\CPFC\Factory\Data;
use App\Model\Report\ProductComplect\Repository\ProductComplectRepository;
use App\Service\File\Delete\FileDeleteInterface;
use Exception;

class EditCPFC implements EditCPFCInterface
{
    private CPFCFactoryAbstract $CPFCFactory;
    private CalculateInterface $calculate;

    public function __construct(CPFCFactoryAbstract $CPFCFactory, CalculateInterface $calculate)
    {
        $this->CPFCFactory = $CPFCFactory;
        $this->calculate = $calculate;
    }

    /**
     * @param Product $product
     * @throws Exception
     */
    public function edit(Product $product, Data $data)
    {
        $cpfc = $product->cpfc;
        $cpfc = $this->CPFCFactory->create($data, $cpfc);
        return $this->calculate->calculate($product);

        return 1;
    }
}
