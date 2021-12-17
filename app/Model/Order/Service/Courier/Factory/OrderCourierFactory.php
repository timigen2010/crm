<?php

namespace App\Model\Order\Service\Courier\Factory;

use App\Model\Order\Entity\OrderCourier;
use Carbon\Carbon;

class OrderCourierFactory implements OrderCourierFactoryInterface
{
    public function create(Data $data): OrderCourier
    {
        $orderCourier = new OrderCourier();
        $orderCourier->order_id = $data->orderId;
        $orderCourier->courier_id = $data->courierId;
        $orderCourier->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $orderCourier->deleted = false;
        $orderCourier->save();
        return $orderCourier;
    }
}
