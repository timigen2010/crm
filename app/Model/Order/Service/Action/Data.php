<?php

namespace App\Model\Order\Service\Action;

class Data
{
    public int $orderId;
    public int $userId;
    public string $info;

    public function __construct(int $orderId, int $userId, string $info)
    {
        $this->orderId = $orderId;
        $this->userId = $userId;
        $this->info = $info;
    }
}
