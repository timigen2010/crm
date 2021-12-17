<?php

namespace App\Model\Discount\Service\Card\Factory;

class Data
{
    public string $cardId;
    public int $customerTelephoneId;
    public int $customerId;
    public string $code;
    public int $userId;

    public function __construct(string $cardId, int $customerTelephoneId, int $customerId, string $code, int $userId)
    {
        $this->cardId = $cardId;
        $this->customerTelephoneId = $customerTelephoneId;
        $this->customerId = $customerId;
        $this->code = $code;
        $this->userId = $userId;
    }
}
