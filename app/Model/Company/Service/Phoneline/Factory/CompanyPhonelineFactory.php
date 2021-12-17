<?php

namespace App\Model\Company\Service\Phoneline\Factory;

use App\Model\Company\Entity\Company;
use App\Model\Company\Entity\Phoneline\CompanyPhoneline;
use App\Model\User\Entity\UserGroup;

class CompanyPhonelineFactory extends CompanyPhonelineFactoryAbstract
{

    /**
     * @param Data $data
     * @param CompanyPhoneline $companyPhoneline
     * @return CompanyPhoneline
     */
    protected function setData(Data $data, CompanyPhoneline $companyPhoneline): CompanyPhoneline
    {
        $company = Company::query()->findOrFail($data->companyId);
        $companyPhoneline->company_id = $data->companyId;
        $companyPhoneline->keyword = $data->keyword;
        $companyPhoneline->descriptions()->delete();
        $companyPhoneline->save();
        foreach ($data->descriptions as $description) {
            $companyPhoneline->descriptions()->create([
                'company_phoneline_id' => $companyPhoneline->company_phoneline_id,
                'name' => $description['name'],
                'language_id' => $description['languageId'],
            ]);
        }
        $companyPhoneline->company()->associate($company);
        return $companyPhoneline;
    }
}
