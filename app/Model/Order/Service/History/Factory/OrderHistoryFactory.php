<?php

namespace App\Model\Order\Service\History\Factory;

use App\Model\Order\Entity\OrderHistory;
use Carbon\Carbon;

class OrderHistoryFactory implements OrderHistoryFactoryInterface
{

    public function create(Data $data): OrderHistory
    {
        $orderHistory = new OrderHistory();
        $orderHistory->order_id = $data->orderId;
        $orderHistory->user_id = $data->userId;
        $orderHistory->order_status_id = $data->orderStatusId;
        $orderHistory->comment = $data->comment;
        $orderHistory->values = serialize($data->values);
        $orderHistory->created_at = Carbon::now()->format("Y-m-d H:i:s");
        $orderHistory->save();
        return $orderHistory;
    }
}
