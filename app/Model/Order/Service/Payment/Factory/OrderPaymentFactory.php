<?php

namespace App\Model\Order\Service\Payment\Factory;

use App\Model\Order\Entity\OrderPayment;

class OrderPaymentFactory implements OrderPaymentFactoryInterface
{

    public function create(Data $data): OrderPayment
    {
        /** @var OrderPayment $orderPayment */
        $orderPayment = OrderPayment::query()->updateOrCreate(
            [ "order_id" => $data->orderId ],
            [
                'first_name' => $data->firstName,
                'last_name' => $data->lastName,
                'address_1' => $data->address_1,
                'address_2' => $data->address_2,
                'coords' => $data->coords,
                'city' => $data->city,
                'method' => $data->method,
                'code' => $data->code,
            ]
        );
        return $orderPayment;
    }
}
