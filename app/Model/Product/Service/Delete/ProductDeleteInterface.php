<?php

namespace App\Model\Product\Service\Delete;

use App\Model\Product\Entity\Product;

interface ProductDeleteInterface
{
    public function delete(Product $product);
}
