<?php

namespace App\Model\Order\Service\DeliveryTime\Factory;

class Data
{
    public int $orderId;
    public string $type;
    public ?string $day;
    public ?string $time;

    public function __construct(int $orderId, string $type, ?string $day, ?string $time)
    {
        $this->orderId = $orderId;
        $this->type = $type;
        $this->day = $day;
        $this->time = $time;
    }
}
