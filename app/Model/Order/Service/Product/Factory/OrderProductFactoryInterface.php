<?php

namespace App\Model\Order\Service\Product\Factory;

use App\Model\Order\Entity\OrderProduct;

interface OrderProductFactoryInterface
{
    public function create(Data $data): OrderProduct;
}
