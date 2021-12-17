<?php

namespace App\Model\Category\Service\Get\GetCategoriesByParams;

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
     * @param Data $data
     * @return mixed
     */
    public function getCategories($data)
    {
        return $this->repository->findBy(
            [
                "status" => $data->status,
                "name" => $data->name,
                "languageId" => $data->languageId
            ],
            [ $data->orderBy => $data->orderDirection ]
        )->loadMissing(['descriptions', 'menus']);
    }
}
