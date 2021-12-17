<?php

namespace App\Model\Weight\Service\Get\GetWeights;

use App\Model\Weight\Repository\WeightClassRepository;
use App\Model\Weight\Service\Get\GetWeightClassesInterface;

class GetWeightClasses implements GetWeightClassesInterface
{
    private WeightClassRepository $repository;

    public function __construct(WeightClassRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Data $data
     * @return mixed
     */
    public function getWeights($data)
    {
       return $this->repository->findBy(['deleted' => false], [$data->orderBy => $data->orderDirection])
           ->loadMissing('descriptions', 'mainWeightClass');
    }
}
