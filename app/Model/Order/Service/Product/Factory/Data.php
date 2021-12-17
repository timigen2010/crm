<?php

namespace App\Model\Order\Service\Product\Factory;

class Data
{
    public int $orderId;
    public int $productId;
    public int $unitClassId;
    public ?string $discountCardId;
    public int $currencyId;
    public string $name;
    public float $amount;
    public float $discount;
    public float $price;
    public float $total;


    public function __construct(int $orderId,
                                int $productId,
                                int $unitClassId,
                                ?string $discountCardId,
                                int $currencyId,
                                string $name,
                                float $amount,
                                float $discount,
                                float $price,
                                float $total)
    {
        $this->orderId = $orderId;
        $this->productId = $productId;
        $this->unitClassId = $unitClassId;
        $this->discountCardId = $discountCardId;
        $this->currencyId = $currencyId;
        $this->name = $name;
        $this->amount = $amount;
        $this->discount = $discount;
        $this->price = $price;
        $this->total = $total;
    }
}
