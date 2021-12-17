<?php

namespace App\Model\Order\Service\Customer\Factory;

use App\Model\Order\Entity\OrderCustomer;

interface OrderCustomerFactoryInterface
{
    public function create(Data $data): OrderCustomer;
}
