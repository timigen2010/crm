<?php

namespace App\Model\Company\Service\Company\Get;

use App\Model\Company\Repository\CompanyRepository;

class GetCompanies implements GetCompaniesInterface
{
    private CompanyRepository $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get($data = [])
    {
        return $this->repository->findBy([])
            ->loadMissing('descriptions');
    }
}
