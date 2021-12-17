<?php

namespace App\Model\Currency\Service\Get\GetCurrencies;

use App\Model\Currency\Repository\CurrencyRepository;
use App\Model\Currency\Service\Get\GetCurrencyInterface;

class GetCurrencies implements GetCurrencyInterface
{
    private CurrencyRepository $repository;

    public function __construct(CurrencyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Data $data
     * @return mixed
     */
    public function getCurrencies($data)
    {
       return $this->repository->findBy(['deleted' => false], [$data->orderBy => $data->orderDirection])
           ->loadMissing(['mainCurrency', 'descriptions']);
    }
}
