<?php

namespace App\Model\Menu\Service\Get;

use App\Model\Menu\Repository\MenuRepository;

class GetMenus implements GetMenusInterface
{
    private MenuRepository $repository;

    public function __construct(MenuRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get($data = [])
    {
        return $this->repository->findBy();
    }
}
