<?php

namespace App\Model\Category\Service\Delete;

use App\Model\Category\Entity\Category;
use App\Service\File\Delete\FileDeleteInterface;

class CategoryDelete implements CategoryDeleteInterface
{
    private FileDeleteInterface $fileDelete;

    public function __construct(FileDeleteInterface $fileDelete)
    {
        $this->fileDelete = $fileDelete;
    }

    /**
     * @param Category $category
     * @throws \Exception
     */
    public function delete(Category $category)
    {
        foreach ($category->images as $image) {
            $this->fileDelete->delete($image->image);
        }
        $category->descriptions()->delete();
        $category->images()->delete();
        $category->menus()->detach();
        $category->delete();
    }
}
