<?php

namespace App\Model\Product\Service\CPFC\Edit;

use App\Model\Product\Entity\Product;
use App\Model\Product\Service\CPFC\Factory\Data;

interface EditCPFCInterface
{
    public function edit(Product $product, Data $data);
}
