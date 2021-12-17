<?php

namespace App\Model\Product\Service\Image\Factory;

use App\Model\Product\Entity\ProductImage;

interface ImageFactoryInterface
{
    public function create(Data $data): ProductImage;
}
