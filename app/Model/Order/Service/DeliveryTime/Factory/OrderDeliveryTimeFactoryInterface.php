<?php

namespace App\Model\Order\Service\DeliveryTime\Factory;

use App\Model\Order\Entity\OrderDeliveryTime;

interface OrderDeliveryTimeFactoryInterface
{
    public function create(Data $data): OrderDeliveryTime;
}
