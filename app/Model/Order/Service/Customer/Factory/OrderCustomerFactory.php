<?php

namespace App\Model\Order\Service\Customer\Factory;

use App\Model\Order\Entity\OrderCustomer;

class OrderCustomerFactory implements OrderCustomerFactoryInterface
{

    public function create(Data $data): OrderCustomer
    {
        /** @var OrderCustomer $orderCustomer */
        $orderCustomer = OrderCustomer::query()->updateOrCreate(
            [ "order_id" => $data->orderId ],
            [
                "customer_id" => $data->customerId,
                "first_name" => $data->firstName,
                "last_name" => $data->lastName,
                "email" => $data->email,
                "telephone" => $data->telephone,
            ]
        );
        return $orderCustomer;
    }
}
