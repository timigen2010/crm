<?php

namespace App\Model\Order\Repository;

use App\Model\Order\Entity\OrderDeliveryTime;

class OrderDeliveryTimeRepository
{
    private OrderDeliveryTime $model;

    public function __construct(OrderDeliveryTime $model)
    {
        $this->model = $model;
    }

    public function deleteByOrderId(int $orderId)
    {
        $this->model->query()
            ->where("order_id", "=", $orderId)
            ->delete();
    }
}
