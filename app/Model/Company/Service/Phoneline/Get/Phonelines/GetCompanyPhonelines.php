<?php

namespace App\Model\Company\Service\Phoneline\Get\Phonelines;

use App\Model\Company\Entity\Phoneline\CompanyPhoneline;
use App\Model\Company\Repository\CompanyPhonelineRepository;
use App\Model\Company\Service\Phoneline\Get\GetCompanyPhonelinesInterface;
use Illuminate\Database\Eloquent\Collection;

class GetCompanyPhonelines implements GetCompanyPhonelinesInterface
{
    private CompanyPhonelineRepository $companyPhonelineRepository;

    public function __construct(CompanyPhonelineRepository $companyPhonelineRepository)
    {
        $this->companyPhonelineRepository = $companyPhonelineRepository;
    }

    /**
     * @param mixed $data
     * @return Collection<CompanyPhoneline>
     */
    public function getPhonelines($data = [])
    {
        return $this->companyPhonelineRepository->findBy([]);
    }
}
