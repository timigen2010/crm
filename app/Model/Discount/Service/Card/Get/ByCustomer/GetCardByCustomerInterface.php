<?php

namespace App\Model\Discount\Service\Card\Get\ByCustomer;

interface GetCardByCustomerInterface
{
    public function get(int $customerId, string $telephone);
}
