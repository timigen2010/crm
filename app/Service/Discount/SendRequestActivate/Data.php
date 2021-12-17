<?php

namespace App\Service\Discount\SendRequestActivate;

class Data
{
    public string $cardId;
    public string $telephone;
    public int $userId;
    public bool $isSendCode;

    public function __construct(string $cardId, string $telephone, int $userId, bool $isSendCode)
    {
        $this->cardId = $cardId;
        $this->telephone = $telephone;
        $this->userId = $userId;
        $this->isSendCode = $isSendCode;
    }


}
