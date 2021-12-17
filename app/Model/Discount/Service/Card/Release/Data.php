<?php

namespace App\Model\Discount\Service\Card\Release;

class Data
{
    public string $cardId;
    public int $customerTelephoneId;
    public int $customerId;
    public int $userId;
    public bool $isSendCode;

    public function __construct(string $cardId, int $customerTelephoneId, int $customerId, int $userId, bool $isSendCode)
    {
        $this->cardId = $cardId;
        $this->customerTelephoneId = $customerTelephoneId;
        $this->customerId = $customerId;
        $this->userId = $userId;
        $this->isSendCode = $isSendCode;
    }
}
