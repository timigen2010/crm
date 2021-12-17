<?php

namespace App\Model\Customer\Service\Group\Factory;


use App\Model\Customer\Entity\Group\CustomerGroup;

abstract class CustomerGroupFactoryAbstract
{
    abstract protected function setData(Data $data, CustomerGroup $group): CustomerGroup;

    public function create(Data $data, ?CustomerGroup $group = null): CustomerGroup
    {
        $group = $group ?? CustomerGroup::query()->make();
        return $this->setData($data, $group);
    }
}
