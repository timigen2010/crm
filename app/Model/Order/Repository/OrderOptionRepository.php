<?php

namespace App\Model\Order\Repository;

use App\Model\Order\Entity\OrderOption;

class OrderOptionRepository
{
    private OrderOption $model;

    public function __construct(OrderOption $model)
    {
        $this->model = $model;
    }

    public function getByOrderId(int $orderId){
        return $this->model->query()
            ->where("order_id", "=", $orderId)->get();
    }

    public function deleteByOrderId(int $orderId)
    {
        $this->model->query()
            ->where("order_id", "=", $orderId)
            ->delete();
    }
}
