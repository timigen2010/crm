<?php

namespace App\Model\Order\Service\Total\Factory;

class Data
{
    public int $orderId;
    public string $code;
    public string $title;
    public float $value;

    public function __construct(int $orderId, string $code, string $title, float $value)
    {
        $this->orderId = $orderId;
        $this->code = $code;
        $this->title = $title;
        $this->value = $value;
    }
}
