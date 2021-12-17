<?php

namespace App\Model\Order\Service\OrderOption\Factory;

class Data
{
    public int $orderId;
    public int $productMainId;
    public string $productMainKey;
    public int $productId;
    public float $amount;

    public function __construct(int $orderId,
                                int $productMainId,
                                string $productMainKey,
                                int $productId,
                                float $amount)
    {
        $this->orderId = $orderId;
        $this->productMainId = $productMainId;
        $this->productMainKey = $productMainKey;
        $this->productId = $productId;
        $this->amount = $amount;
    }
}
