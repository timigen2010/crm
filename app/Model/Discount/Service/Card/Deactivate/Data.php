<?php

namespace App\Model\Discount\Service\Card\Deactivate;

class Data
{
    public string $telephone;
    public string $cardId;
    public string $code;
    public int $userId;

    public function __construct(string $telephone, string $cardId, string $code, int $userId)
    {
        $this->telephone = $telephone;
        $this->cardId = $cardId;
        $this->code = $code;
        $this->userId = $userId;
    }
}
