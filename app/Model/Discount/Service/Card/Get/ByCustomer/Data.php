<?php

namespace App\Model\Discount\Service\Card\Get\ByCustomer;

class Data
{
    public string $telephone;
    public int $customerId;

    public function __construct(string $telephone, int $customerId)
    {
        $this->telephone = $telephone;
        $this->customerId = $customerId;
    }
}
