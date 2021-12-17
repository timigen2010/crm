<?php

namespace App\Model\Product\Service\CPFC\Calculate;

use App\Model\Product\Entity\Product;

interface CalculateInterface
{
    public function calculate(Product $product);
}
