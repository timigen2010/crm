<?php

namespace App\Model\Order\Service\Total\Factory;

use App\Model\Order\Entity\OrderTotal;

interface OrderTotalFactoryInterface
{
    public function create(Data $data): OrderTotal;
}
