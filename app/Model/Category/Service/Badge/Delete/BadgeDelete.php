<?php

namespace App\Model\Category\Service\Badge\Delete;

use App\Model\Category\Entity\CategoryBadge;
use App\Service\File\Delete\FileDeleteInterface;

class BadgeDelete implements BadgeDeleteInterface
{
    private FileDeleteInterface $fileDelete;

    public function __construct(FileDeleteInterface $fileDelete)
    {
        $this->fileDelete = $fileDelete;
    }

    /**
     * @param CategoryBadge $badge
     * @throws \Exception
     */
    public function delete(CategoryBadge $badge)
    {
        $this->fileDelete->delete($badge->image);
        $badge->delete();
    }
}
