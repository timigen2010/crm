<?php

namespace App\Model\Order\Service\Action;

use App\Model\Order\Entity\OrderAction;

interface OrderActionFactoryInterface
{
    public function create(Data $data): OrderAction;
}
