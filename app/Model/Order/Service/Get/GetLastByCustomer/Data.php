<?php

namespace App\Model\Order\Service\Get\GetLastByCustomer;

class Data
{
    public int $customerId;

    public function __construct(int $customerId)
    {
        $this->customerId = $customerId;
    }
}
