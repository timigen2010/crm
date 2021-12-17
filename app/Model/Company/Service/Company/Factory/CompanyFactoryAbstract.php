<?php

namespace App\Model\Company\Service\Company\Factory;

use App\Model\Company\Entity\Company;
use Illuminate\Support\Facades\DB;

abstract class CompanyFactoryAbstract
{
    abstract protected function setData(Data $data, Company $company): Company;

    public function create(Data $data, ?Company $company = null): Company
    {
        return DB::transaction(function () use($data, $company) {
            $company = $company ?? Company::query()->make();
            return $this->setData($data, $company);
        });
    }
}
