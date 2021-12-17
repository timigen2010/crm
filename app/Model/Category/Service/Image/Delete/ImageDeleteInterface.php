<?php

namespace App\Model\Category\Service\Image\Delete;

use App\Model\Category\Entity\CategoryImage;

interface ImageDeleteInterface
{
    public function delete(CategoryImage $categoryImage);
}
