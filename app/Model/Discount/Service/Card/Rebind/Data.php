<?php

namespace App\Model\Discount\Service\Card\Rebind;

class Data
{
    public int $customerTelephoneId;
    public string $cardId;
    public string $code;
    public int $userId;
    public int $customerId;

    public function __construct(int $customerTelephoneId, string $cardId, string $code, int $userId, int $customerId)
    {
        $this->customerTelephoneId = $customerTelephoneId;
        $this->cardId = $cardId;
        $this->code = $code;
        $this->userId = $userId;
        $this->customerId = $customerId;
    }
}
