<?php

namespace App\Model\Courier\Service\Get;

use App\Model\Courier\Repository\CourierRepository;
use App\Model\Menu\Repository\MenuRepository;

class GetCouriers implements GetCouriersInterface
{
    private CourierRepository $repository;

    public function __construct(CourierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get($data = [])
    {
        return $this->repository->findBy();
    }
}
