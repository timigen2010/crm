<?php

namespace App\Model\Discount\Service\CardOperation\Factory;

class Data
{
    public string $cardId;
    public int $orderId;
    public float $orderCost;
    public float $discount;
    public float $orderCostDiscount;
    public int $userId;
    public float $bonusAdd;
    public float $bonusUse;
    public string $type;
    public string $comment;
    public string $telephoneOld;
    public string $telephoneNew;

    public function __construct(string $cardId,
                                int $orderId,
                                float $orderCost,
                                float $discount,
                                float $orderCostDiscount,
                                int $userId,
                                float $bonusAdd,
                                float $bonusUse,
                                string $type,
                                string $comment = '',
                                string $telephoneOld = '',
                                string $telephoneNew = '')
    {
        $this->cardId = $cardId;
        $this->orderId = $orderId;
        $this->orderCost = $orderCost;
        $this->discount = $discount;
        $this->orderCostDiscount = $orderCostDiscount;
        $this->userId = $userId;
        $this->bonusAdd = $bonusAdd;
        $this->bonusUse = $bonusUse;
        $this->type = $type;
        $this->comment = $comment;
        $this->telephoneOld = $telephoneOld;
        $this->telephoneNew = $telephoneNew;
    }


}
