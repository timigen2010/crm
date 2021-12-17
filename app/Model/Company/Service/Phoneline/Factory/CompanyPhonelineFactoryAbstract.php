<?php

namespace App\Model\Company\Service\Phoneline\Factory;


use App\Model\Company\Entity\Phoneline\CompanyPhoneline;

abstract class CompanyPhonelineFactoryAbstract
{
    abstract protected function setData(Data $data, CompanyPhoneline $companyPhoneline): CompanyPhoneline;

    public function create(Data $data, ?CompanyPhoneline $phoneline = null): CompanyPhoneline
    {
        $phoneline = $phoneline ?? CompanyPhoneline::query()->make();
        return $this->setData($data, $phoneline);
    }
}
