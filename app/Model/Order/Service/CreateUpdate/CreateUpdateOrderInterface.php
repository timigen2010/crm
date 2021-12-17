<?php

namespace App\Model\Order\Service\CreateUpdate;

use App\Model\Order\Entity\Order;

interface CreateUpdateOrderInterface
{
    public function handle(Data $data, Order $order = null);
}
