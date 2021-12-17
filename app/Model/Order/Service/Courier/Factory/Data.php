<?php

namespace App\Model\Order\Service\Courier\Factory;

class Data
{
    public int $orderId;
    public int $courierId;

    public function __construct(int $orderId, int $courierId)
    {
        $this->orderId = $orderId;
        $this->courierId = $courierId;
    }
}
