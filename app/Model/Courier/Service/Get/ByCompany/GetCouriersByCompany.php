<?php

namespace App\Model\Courier\Service\Get\ByCompany;

use App\Model\Courier\Repository\CourierRepository;
use App\Model\Courier\Service\Get\ByCompany\GetCouriersByCompanyInterface;
use App\Model\Menu\Repository\MenuRepository;

class GetCouriersByCompany implements GetCouriersByCompanyInterface
{
    private CourierRepository $repository;

    public function __construct(CourierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(int $companyId)
    {
        return $this->repository->getCouriersByCompanyId($companyId);
    }
}
