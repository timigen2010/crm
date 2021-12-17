<?php

namespace App\Model\Order\Service\Action;

use App\Model\Order\Entity\OrderAction;
use Carbon\Carbon;

class OrderActionFactory implements OrderActionFactoryInterface
{

    public function create(Data $data): OrderAction
    {
        $orderAction = new OrderAction();
        $orderAction->order_id = $data->orderId;
        $orderAction->user_id = $data->userId;
        $orderAction->info = $data->info;
        $orderAction->created_at = Carbon::now()->format("Y-m-d H:i:s");
        $orderAction->save();
        return $orderAction;
    }
}
