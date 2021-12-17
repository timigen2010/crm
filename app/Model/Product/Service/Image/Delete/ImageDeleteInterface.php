<?php

namespace App\Model\Product\Service\Image\Delete;

use App\Model\Product\Entity\ProductImage;

interface ImageDeleteInterface
{
    public function delete(ProductImage $productImage);
}
