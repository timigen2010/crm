<?php

namespace App\Model\Order\Service\Courier\Factory;

use App\Model\Order\Entity\OrderCourier;

interface OrderCourierFactoryInterface
{
    public function create(Data $data): OrderCourier;
}
