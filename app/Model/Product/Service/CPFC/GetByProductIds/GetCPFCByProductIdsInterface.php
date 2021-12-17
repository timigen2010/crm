<?php

namespace App\Model\Product\Service\CPFC\GetByProductIds;

use App\Model\Product\Entity\Product;
use App\Model\Product\Service\CPFC\Factory\Data;

interface GetCPFCByProductIdsInterface
{
    public function get(array $productIds);
}
