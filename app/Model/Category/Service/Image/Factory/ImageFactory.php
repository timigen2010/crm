<?php

namespace App\Model\Category\Service\Image\Factory;

use App\Model\Category\Entity\CategoryImage;

class ImageFactory implements ImageFactoryInterface
{

    public function create(Data $data): CategoryImage
    {
        $image = new CategoryImage();
        $image->category_id = $data->categoryId;
        $image->image = $data->image;
        $image->image_type = $data->imageType;
        $image->save();
        return $image;
    }
}
