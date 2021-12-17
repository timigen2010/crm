<?php

namespace App\Model\Discount\Service\Card\BalanceReplenishment;

class Data
{
    public string $cardId;
    public string $telephone;
    public float $bonuses;
    public string $comment;
    public int $userId;

    public function __construct(string $cardId, string $telephone, float $bonuses, string $comment, int $userId)
    {
        $this->cardId = $cardId;
        $this->telephone = $telephone;
        $this->bonuses = $bonuses;
        $this->comment = $comment;
        $this->userId = $userId;
    }
}
