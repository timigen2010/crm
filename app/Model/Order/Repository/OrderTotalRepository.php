<?php

namespace App\Model\Order\Repository;

use App\Model\Order\Entity\OrderTotal;
use Illuminate\Support\Facades\DB;

class OrderTotalRepository
{
    private OrderTotal $model;

    public function __construct(OrderTotal $model)
    {
        $this->model = $model;
    }

    public function deleteByOrderId(int $orderId)
    {
        $this->model->query()
            ->where("order_id", "=", $orderId)
            ->delete();
    }

    public function findByOrderId(int $orderId)
    {
        return $this->model->query()
            ->where("order_id", "=", $orderId)
            ->get();
    }

    public function getGroupByOrderId(array $orderIds)
    {
        return DB::table("order_totals")
            ->whereIn("order_id", $orderIds)
            ->groupBy("order_id")
            ->select([
                "order_id",
                DB::raw("json_arrayagg(json_object('code', code, 'value', value )) as totals")
            ])
            ->get()->map(function ($item) {
                return [
                    "order_id" => $item->order_id,
                    "totals" => json_decode($item->totals, true),
                ];
            });
    }
}
