<?php

namespace App\Model\Language\Service\Get\GetLanguages;

use App\Model\Language\Repository\LanguageRepository;
use App\Model\Language\Service\Get\GetLanguagesInterface;

class GetLanguages implements GetLanguagesInterface
{
    private LanguageRepository $repository;

    public function __construct(LanguageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Data $data
     * @return mixed
     */
    public function getLanguages($data)
    {
       return $this->repository->findBy(['deleted' => false], [$data->orderBy => $data->orderDirection]);
    }
}
