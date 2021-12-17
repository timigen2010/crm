<?php

namespace App\Model\Company\Repository;

use App\Model\Company\Entity\CompanySetting;

class CompanySettingRepository
{
    private CompanySetting $model;

    public function __construct(CompanySetting $model)
    {
        $this->model = $model;
    }

    public function findOneByCompanyIdAndKey(int $companyId, string $key)
    {
        return $this->model->query()
            ->where('company_id', '=', $companyId)
            ->where('key', '=', $key)
            ->first();
    }
}
