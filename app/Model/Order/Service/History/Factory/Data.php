<?php

namespace App\Model\Order\Service\History\Factory;

class Data
{
    public int $orderId;
    public int $userId;
    public int $orderStatusId;
    public string $comment;
    public array $values;

    public function __construct(int $orderId, int $userId, int $orderStatusId, string $comment, array $values)
    {
        $this->orderId = $orderId;
        $this->userId = $userId;
        $this->orderStatusId = $orderStatusId;
        $this->comment = $comment;
        $this->values = $values;
    }
}
