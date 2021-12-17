<?php

namespace App\Model\Product\Service\CPFC\Factory;

use App\Model\Product\Entity\ProductCPFC;
use App\Model\Product\Service\CPFC\Factory\CPFCFactoryAbstract;

class CPFCFactory extends CPFCFactoryAbstract
{
    protected function setData(Data $data, ProductCPFC $productCPFC): ProductCPFC
    {
        $productCPFC->product_id = $data->productId;
        $productCPFC->calories = $data->calories;
        $productCPFC->protein = $data->protein;
        $productCPFC->fat = $data->fat;
        $productCPFC->carbs = $data->carbs;

        $productCPFC->save();

        return $productCPFC;
    }
}
