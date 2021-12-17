<?php

namespace App\Model\Order\Service\History\Factory;

use App\Model\Order\Entity\OrderHistory;

interface OrderHistoryFactoryInterface
{
    public function create(Data $data): OrderHistory;
}
