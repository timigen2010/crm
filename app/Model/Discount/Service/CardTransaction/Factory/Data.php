<?php

namespace App\Model\Discount\Service\CardTransaction\Factory;

class Data
{
    public string $cardId;
    public int $userId;
    public int $operationId;
    public float $amount;
    public float $balance;
    public string $status;

    public function __construct(string $cardId,
                                int $userId,
                                int $operationId,
                                float $amount,
                                float $balance,
                                string $status)
    {
        $this->cardId = $cardId;
        $this->userId = $userId;
        $this->operationId = $operationId;
        $this->amount = $amount;
        $this->balance = $balance;
        $this->status = $status;
    }


}
