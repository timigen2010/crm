<?php

namespace App\Model\Customer\Service\Group\Factory;

use App\Model\Customer\Entity\Group\CustomerGroup;

class CustomerGroupFactory extends CustomerGroupFactoryAbstract
{

    /**
     * @param Data $data
     * @param CustomerGroup $group
     * @return CustomerGroup
     */
    protected function setData(Data $data, CustomerGroup $group): CustomerGroup
    {
        $group->company_id = $data->companyId;
        $group->customerGroupDescriptions()->delete();
        $group->save();
        foreach ($data->descriptions as $description) {
            $group->customerGroupDescriptions()->create([
                'customer_group_id' => $group->customer_group_id,
                'name' => $description['name'],
                'description' => $description['description'],
                'language_id' => $description['languageId'],
            ]);
        }
        return $group;
    }
}
