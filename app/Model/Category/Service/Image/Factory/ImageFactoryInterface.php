<?php

namespace App\Model\Category\Service\Image\Factory;

use App\Model\Category\Entity\CategoryImage;

interface ImageFactoryInterface
{
    public function create(Data $data): CategoryImage;
}
