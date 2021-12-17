<?php

namespace App\Model\Category\Service\Image\Delete;

use App\Model\Category\Entity\CategoryImage;
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
     * @param CategoryImage $categoryImage
     * @throws Exception
     */
    public function delete(CategoryImage $categoryImage)
    {
        $this->fileDelete->delete($categoryImage->image);
        $categoryImage->delete();
    }
}
