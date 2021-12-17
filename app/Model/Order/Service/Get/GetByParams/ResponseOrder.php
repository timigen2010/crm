<?php

namespace App\Model\Order\Service\Get\GetByParams;

class ResponseOrder
{
    public int $orderId;
    public int $orderStatusId;
    public int $userId;
    public string $deliveryMethod;
    public string $firstName;
    public string $statusName;
    public float $subTotal;
    public float $cash;
    public ?float $discount;
    public float $total;
    public string $createdAt;
    public string $updatedAt;

    public function __construct(int $orderId,
                                int $orderStatusId,
                                int $userId,
                                string $deliveryMethod,
                                string $firstName,
                                string $statusName,
                                float $subTotal,
                                float $cash,
                                ?float $discount,
                                float $total,
                                string $createdAt,
                                string $updatedAt)
    {
        $this->orderId = $orderId;
        $this->orderStatusId = $orderStatusId;
        $this->userId = $userId;
        $this->deliveryMethod = $deliveryMethod;
        $this->firstName = $firstName;
        $this->statusName = $statusName;
        $this->subTotal = $subTotal;
        $this->cash = $cash;
        $this->discount = $discount;
        $this->total = $total;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }


}
