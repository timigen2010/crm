<?php

namespace App\Model\Order\Service\DeliveryTime\Factory;

use App\Model\Order\Entity\OrderDeliveryTime;

class OrderDeliveryTimeFactory implements OrderDeliveryTimeFactoryInterface
{
    public function create(Data $data): OrderDeliveryTime
    {
        $orderDeliveryTime = new OrderDeliveryTime();
        $orderDeliveryTime->order_id = $data->orderId;
        $orderDeliveryTime->type = $data->type;
        $orderDeliveryTime->day = $data->day;
        $orderDeliveryTime->time = $data->time;
        $orderDeliveryTime->save();
        return $orderDeliveryTime;
    }
}
