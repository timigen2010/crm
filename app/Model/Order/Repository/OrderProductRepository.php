<?php

namespace App\Model\Order\Repository;

use App\Model\Order\Entity\OrderProduct;

class OrderProductRepository
{
    private OrderProduct $model;

    public function __construct(OrderProduct $model)
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
