<?php

namespace App\Model\Product\Service\CPFC\GetByProductId;

use App\Model\Product\Entity\Product;
use App\Model\Product\Service\CPFC\Factory\Data;

interface GetCPFCByProductIdInterface
{
    public function get(int $productId);
}
