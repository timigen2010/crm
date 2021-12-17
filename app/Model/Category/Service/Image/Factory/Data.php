<?php

namespace App\Model\Category\Service\Image\Factory;

class Data
{
    public int $categoryId;
    public string $image;
    public int $imageType;

    public function __construct(int $categoryId, string $image, int $imageType)
    {
        $this->categoryId = $categoryId;
        $this->image = $image;
        $this->imageType = $imageType;
    }
}
