<?php

namespace App\Model\Company\Service\Company\Factory;

use App\Model\Company\Entity\Company;

class CompanyFactory extends CompanyFactoryAbstract
{

    protected function setData(Data $data, Company $company): Company
    {
        $company->is_admin = $data->isAdmin;
        $company->url = $data->url;
        $company->ssl = $data->ssl;
        $company->settings()->delete();
        $company->descriptions()->delete();
        $company->save();
        foreach($data->settings as $setting) {
            $company->settings()->insert([
                'company_id' => $company->company_id,
                'code' => $setting['code'],
                'key' => $setting['key'],
                'value' => $setting['isSerialized'] ? serialize($setting['value']) : $setting['value'],
                'is_serialized' => $setting['isSerialized']
            ]);
        }
        foreach($data->descriptions as $description) {
            $company->descriptions()->insert([
                'company_id' => $company->company_id,
                'language_id' => $description['languageId'],
                'name' => $description['name'],
                'long_name' => $description['longName'],
                'keyword' => $description['keyword'],
            ]);
        }
        return $company;
    }
}
