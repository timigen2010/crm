<?php

namespace App\Model\Product\Service\Image\Factory;

class Data
{
    public int $productId;
    public string $image;

    public function __construct(int $productId, string $image)
    {
        $this->productId = $productId;
        $this->image = $image;
    }
}
