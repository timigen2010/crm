<?php

namespace App\Model\Order\Repository;

use App\Model\Order\Entity\OrderCookComment;

class OrderCookCommentRepository
{
    private OrderCookComment $model;

    public function __construct(OrderCookComment $model)
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
