<?php

namespace App\Model\Order\Repository;

use App\Model\Order\Entity\OrderCourier;

class OrderCourierRepository
{
    private OrderCourier $model;

    public function __construct(OrderCourier $model)
    {
        $this->model = $model;
    }

    public function setDeletedByOrderId(int $orderId)
    {
        $this->model->query()
            ->where("order_id", "=", $orderId)
            ->update(["deleted" => true]);
    }
}
