<?php

namespace App\Model\Discount\Service\CardTransaction\Factory;

use App\Model\Discount\Entity\DiscountCardTransaction;
use Carbon\Carbon;

class CardTransactionFactory implements CardTransactionFactoryInterface
{

    public function create(Data $data): DiscountCardTransaction
    {
        $transaction = new DiscountCardTransaction();
        $transaction->discount_card_operation_id = $data->operationId;
        $transaction->discount_card_id = $data->cardId;
        $transaction->amount = $data->amount;
        $transaction->status = $data->status;
        $transaction->user_id = $data->userId;
        $transaction->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $transaction->save();
        return $transaction;
    }
}
