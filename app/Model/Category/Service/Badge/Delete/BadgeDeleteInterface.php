<?php

namespace App\Model\Category\Service\Badge\Delete;

use App\Model\Category\Entity\CategoryBadge;

interface BadgeDeleteInterface
{
    public function delete(CategoryBadge $badge);
}
