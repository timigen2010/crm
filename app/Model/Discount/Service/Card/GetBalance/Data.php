<?php

namespace App\Model\Discount\Service\Card\GetBalance;

class Data
{
    public string $telephone;
    public string $cardId;

    public function __construct(string $telephone, string $cardId)
    {
        $this->telephone = $telephone;
        $this->cardId = $cardId;
    }
}
