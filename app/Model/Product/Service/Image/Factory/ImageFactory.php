<?php

namespace App\Model\Product\Service\Image\Factory;

use App\Model\Product\Entity\ProductImage;

class ImageFactory implements ImageFactoryInterface
{
    public function create(Data $data): ProductImage
    {
        $image = new ProductImage();
        $image->product_id = $data->productId;
        $image->image = $data->image;
        $image->save();
        return $image;
    }
}
