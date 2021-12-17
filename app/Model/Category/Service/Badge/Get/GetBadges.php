<?php

namespace App\Model\Category\Service\Badge\Get;

use App\Model\Category\Repository\CategoryBadgeRepository;

class GetBadges implements GetBadgesInterface
{
    private CategoryBadgeRepository $repository;

    public function __construct(CategoryBadgeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getBadges($data = [])
    {
        return $this->repository->findBy();
    }
}
