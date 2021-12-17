<?php

namespace App\Model\Order\Service\Total\Factory;

use App\Model\Order\Entity\OrderTotal;

class OrderTotalFactory implements OrderTotalFactoryInterface
{

    public function create(Data $data): OrderTotal
    {
        $orderTotal = new OrderTotal();
        $orderTotal->order_id = $data->orderId;
        $orderTotal->code = $data->code;
        $orderTotal->title = $data->title;
        $orderTotal->value = $data->value;
        $orderTotal->save();
        return $orderTotal;
    }
}
