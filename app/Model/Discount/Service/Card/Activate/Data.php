<?php

namespace App\Model\Discount\Service\Card\Activate;

class Data
{
    public int $customerTelephoneId;
    public string $cardId;
    public string $code;
    public int $userId;
    public float $bonusAdd;

    public function __construct(int $customerTelephoneId, string $cardId, string $code, int $userId, float $bonusAdd)
    {
        $this->customerTelephoneId = $customerTelephoneId;
        $this->cardId = $cardId;
        $this->code = $code;
        $this->userId = $userId;
        $this->bonusAdd = $bonusAdd;
    }


}
