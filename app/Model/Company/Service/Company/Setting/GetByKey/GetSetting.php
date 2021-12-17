<?php

namespace App\Model\Company\Service\Company\Setting\GetByKey;

use App\Model\Company\Repository\CompanySettingRepository;

class GetSetting implements GetSettingInterface
{
    private CompanySettingRepository $repository;

    public function __construct(CompanySettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function get(int $companyId, string $key)
    {
       return $this->repository->findOneByCompanyIdAndKey($companyId, $key);
    }
}
