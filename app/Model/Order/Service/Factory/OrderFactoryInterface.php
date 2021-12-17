<?php

namespace App\Model\Order\Service\Factory;

use App\Model\Order\Entity\Order;

interface OrderFactoryInterface
{
    public function create(Data $data, Order $order = null): Order;
}
