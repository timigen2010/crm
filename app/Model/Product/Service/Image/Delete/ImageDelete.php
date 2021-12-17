<?php

namespace App\Model\Product\Service\Image\Delete;

use App\Model\Product\Entity\ProductImage;
use App\Service\File\Delete\FileDeleteInterface;
use Exception;

class ImageDelete implements ImageDeleteInterface
{
    private FileDeleteInterface $fileDelete;

    public function __construct(FileDeleteInterface $fileDelete)
    {
        $this->fileDelete = $fileDelete;
    }

    /**
     * @param ProductImage $productImage
     * @throws Exception
     */
    public function delete(ProductImage $productImage)
    {
        $this->fileDelete->delete($productImage->image);
        $productImage->delete();
    }
}
