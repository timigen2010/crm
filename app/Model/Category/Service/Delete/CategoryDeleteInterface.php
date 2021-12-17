<?php

namespace App\Model\Category\Service\Delete;

use App\Model\Category\Entity\Category;

interface CategoryDeleteInterface
{
    public function delete(Category $category);
}
