<?php

namespace App\Model\Category\Service\Get\GetByMenu;

use App\Model\Category\Repository\CategoryRepository;
use App\Model\Category\Service\Get\GetCategoriesInterface;

class GetCategories implements GetCategoriesInterface
{
    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $menuId
     * @return mixed
     */
    public function getCategories($menuId)
    {
        return $this->repository->findByMenuId($menuId);
    }
}
