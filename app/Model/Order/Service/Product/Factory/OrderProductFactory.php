<?php

namespace App\Model\Order\Service\Product\Factory;

use App\Model\Order\Entity\OrderProduct;

class OrderProductFactory implements OrderProductFactoryInterface
{
    public function create(Data $data): OrderProduct
    {
        $orderProduct = new OrderProduct();
        $orderProduct->order_id = $data->orderId;
        $orderProduct->product_id = $data->productId;
        $orderProduct->unit_class_id = $data->unitClassId;
        $orderProduct->discount_card_id = $data->discountCardId;
        $orderProduct->currency_id = $data->currencyId;
        $orderProduct->name = $data->name;
        $orderProduct->amount = $data->amount;
        $orderProduct->discount = $data->discount;
        $orderProduct->price = $data->price;
        $orderProduct->total = $data->total;
        $orderProduct->deleted = false;
        $orderProduct->save();
        return $orderProduct;
    }
}
