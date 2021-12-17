<?php

namespace App\Model\Call\Service\Get\GetCallsByParams;

use App\Model\Call\Repository\CallActivityRepository;
use App\Model\Call\Service\Get\GetCallActivitiesInterface;

class GetCallsByParams implements GetCallActivitiesInterface
{
    private CallActivityRepository $repository;

    public function __construct(CallActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Data $data
     * @return mixed
     */
    public function getCalls($data)
    {
        return $this->repository->findBy([
            'source' => $data->source,
            'destination' => $data->destination,
            'companyId' => $data->companyId,
            'statusDisposition' => $data->statusDisposition,
            'dateStart' => $data->dateStart,
            'dateEnd' => $data->dateEnd,
        ], [ $data->orderBy => $data->orderDirection ]);
    }
}
