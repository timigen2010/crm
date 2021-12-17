<?php

namespace App\Model\Order\Service\OrderOption\Factory;

use App\Model\Order\Entity\OrderOption;

class OrderOptionFactory implements OrderOptionFactoryInterface
{
    public function create(Data $data): OrderOption
    {
        $orderOption = new OrderOption();
        $orderOption->order_id = $data->orderId;
        $orderOption->product_id = $data->productId;
        $orderOption->product_main_id = $data->productMainId;
        $orderOption->product_id = $data->productId;
        $orderOption->product_main_key = $data->productMainKey;
        $orderOption->amount = $data->amount;
        $orderOption->save();
        return $orderOption;
    }
}
