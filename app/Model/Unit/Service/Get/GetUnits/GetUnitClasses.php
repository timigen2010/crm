<?php

namespace App\Model\Unit\Service\Get\GetUnits;

use App\Model\Unit\Repository\UnitClassRepository;
use App\Model\Unit\Service\Get\GetUnitClassesInterface;

class GetUnitClasses implements GetUnitClassesInterface
{
    private UnitClassRepository $repository;

    public function __construct(UnitClassRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Data $data
     * @return mixed
     */
    public function getUnits($data)
    {
       return $this->repository->findBy(['deleted' => false], [$data->orderBy => $data->orderDirection])
           ->loadMissing('descriptions', 'mainUnitClass');
    }
}
