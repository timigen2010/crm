<?php

namespace App\Model\Product\Service\Delete;

use App\Model\Product\Entity\Product;
use App\Service\File\Delete\FileDeleteInterface;

class ProductDelete implements ProductDeleteInterface
{
    private FileDeleteInterface $fileDelete;

    public function __construct(FileDeleteInterface $fileDelete)
    {
        $this->fileDelete = $fileDelete;
    }

    public function delete(Product $product)
    {
        foreach ($product->images as $image) {
            $this->fileDelete->delete($image->image);
        }
        $product->images()->delete();
        $product->deleted = true;
        $product->save();
    }
}
