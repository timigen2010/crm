<?php

namespace App\Service\Customer\CreateUpdate;

use App\Model\Customer\Entity\Customer;
use App\Model\Customer\Service\Factory\Data;

interface CreateUpdateCustomerInterface
{
    public function handle(Data $data, Customer $customer = null): Customer;
}
