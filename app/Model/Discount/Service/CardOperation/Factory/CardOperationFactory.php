<?php

namespace App\Model\Discount\Service\CardOperation\Factory;

use App\Model\Discount\Entity\DiscountCardOperation;
use Carbon\Carbon;

class CardOperationFactory implements CardOperationFactoryInterface
{

    public function create(Data $data): DiscountCardOperation
    {
        $operation = new DiscountCardOperation();
        $operation->discount_card_id = $data->cardId;
        $operation->order_id = $data->orderId;
        $operation->user_id = $data->userId;
        $operation->type = $data->type;
        $operation->comment = $data->comment;
        $operation->bonus_add = $data->bonusAdd;
        $operation->telephone_old = $data->telephoneOld;
        $operation->telephone_new = $data->telephoneNew;
        $operation->order_cost = $data->orderCost;
        $operation->order_cost_discount = $data->orderCostDiscount;
        $operation->bonus_use = $data->bonusUse;
        $operation->discount = $data->discount;
        $operation->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $operation->save();
        return $operation;
    }
}
