<?php

namespace App\Model\Customer\Service\Factory;

use App\Model\Customer\Entity\Customer;

abstract class CustomerFactoryAbstract
{
    abstract protected function setData(Data $data, Customer $customer): Customer;

    public function create(Data $data, ?Customer $customer = null): Customer
    {
        $customer = $customer ?? Customer::query()->make();
        return $this->setData($data, $customer);
    }
}
